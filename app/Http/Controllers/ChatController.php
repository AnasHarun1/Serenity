<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth; // Untuk tahu siapa yang login
use Illuminate\Support\Facades\Log; // Import Log Facade
use App\Models\ChatMessage; // Panggil model Chat
use App\Models\Mood;

class ChatController extends Controller
{
    // 1. Tampilkan Halaman Chat
    public function index()
    {
        // Ambil riwayat chat user yang sedang login
        $messages = ChatMessage::where('user_id', Auth::id())->get();

        return view('chat.index', compact('messages'));
    }

    // 2. Proses Kirim Pesan ke AI
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        $userId = Auth::id();

        // A. Simpan Chat User ke Database
        ChatMessage::create([
            'user_id' => $userId,
            'message' => $userMessage,
            'is_user' => true, // Ini chat dari manusia
        ]);

        // --- AMBIL RIWAYAT MOOD (AI CONTEXT) ---
        $recentMoods = Mood::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $moodContext = "Riwayat Emosi User (5 hari terakhir):\n";
        foreach ($recentMoods as $mood) {
            $moodContext .= "- " . $mood->created_at->format('d M') . ": Level " . $mood->emoji_level . " (" . ($mood->tags ?? '-') . ")\n";
        }
        // ----------------------------------------

        // --- AMBIL 30 CHAT TERAKHIR (CONTEXT WINDOW) ---
        $history = ChatMessage::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get()
            ->reverse();

        $messagesForAI = [
            [
                'role' => 'system',
                'content' => "Kamu adalah 'Serenity', teman curhat psikologis yang penuh empati dan pengertian. \n" .
                    "Sifatmu: Hangat, tidak menghakimi, pendengar yang baik, dan memberikan saran yang menenangkan.\n" .
                    "INSTRUKSI PENTING: \n" .
                    "1. Gunakan Bahasa Indonesia yang natural dan santai. Seperti teman yang peduli\n" .
                    "2. Anggap pesan-pesan di atas adalah ingatanmu.\n" .
                    "3. Jika pengguna menunjukkan tanda-tanda ingin menyakiti diri sendiri atau bunuh diri, STOP percakapan dan berikan pesan berikut: 'Saya mendengar rasa sakitmu, tapi saya hanyalah AI. Tolong segera hubungi profesional atau layanan darurat di 119.'\n"
                    "4. Jika kamu berpikir (thinking process), abaikan tag <think>...</think> di output akhir.\n" .
                    "5. Jaga jawaban tetap ringkas dan suportif.kecuali jika user meminta penjelasan lebih lanjut\n\n" .
                    $moodContext,
            ]
        ];

        // Masukkan history chat (termasuk pesan user yang baru saja disimpan)
        foreach ($history as $chat) {
            $messagesForAI[] = [
                'role' => $chat->is_user ? 'user' : 'assistant',
                'content' => $chat->message,
            ];
        }

        // Tambahkan pesan user saat ini (yang paling baru)
        $messagesForAI[] = [
            'role' => 'user',
            'content' => $userMessage,
        ];
        // ----------------------------------------

        // B. Kirim ke Groq AI
        $apiKey = env('GROQ_API_KEY');

        try {
            // "withoutVerifying()" penting untuk localhost Windows agar tidak error SSL
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model' => 'llama-3.3-70b-versatile',
                        'messages' => $messagesForAI,
                        'temperature' => 0.6,
                    ]);

            if ($response->failed()) {
                throw new \Exception('API Error: ' . $response->body());
            }

            // Ambil teks jawaban AI (Format OpenAI)
            $rawReply = $response->json()['choices'][0]['message']['content'];

            // Bersihkan tag <think>...</think> jika ada
            $aiReply = preg_replace('/<think>.*?<\/think>/s', '', $rawReply);
            $aiReply = trim($aiReply);

        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage());
            // Tampilkan pesan error asli ke user untuk debugging
            $aiReply = "Maaf, terjadi error sistem: " . $e->getMessage();
        }

        // C. Simpan Jawaban AI ke Database
        $botMessage = ChatMessage::create([
            'user_id' => $userId,
            'message' => $aiReply,
            'is_user' => false, // Ini chat dari Robot
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'user_message' => [
                    'message' => $userMessage,
                    'is_user' => true,
                    'created_at' => now()->format('H:i'),
                ],
                'ai_message' => [
                    'message' => $aiReply,
                    'is_user' => false,
                    'created_at' => now()->format('H:i'),
                ]
            ]);
        }

        // Kembali ke halaman chat
        return redirect()->route('chat.index');
    }

    // 3. Hapus Riwayat Chat (Opsional)
    public function clearChat()
    {
        ChatMessage::where('user_id', Auth::id())->delete();
        return redirect()->route('chat.index');
    }
}