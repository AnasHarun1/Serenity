<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ChatMessage;
use App\Models\Mood;

class ChatController extends Controller
{

    public function index()
    {

        $messages = ChatMessage::where('user_id', Auth::id())->get();

        return view('chat.index', compact('messages'));
    }


    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        $userId = Auth::id();


        ChatMessage::create([
            'user_id' => $userId,
            'message' => $userMessage,
            'is_user' => true,
        ]);

        // Jika mode expert, tidak panggil AI API
        if (session('chat_mode') === 'expert') {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'user_message' => [
                        'message' => $userMessage,
                        'is_user' => true,
                        'created_at' => now()->format('H:i'),
                    ],
                    'ai_message' => null
                ]);
            }
            return redirect()->route('chat.index');
        }


        $recentMoods = Mood::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $moodContext = "Riwayat Emosi User (5 hari terakhir):\n";
        foreach ($recentMoods as $mood) {
            $moodContext .= "- " . $mood->created_at->format('d M') . ": Level " . $mood->emoji_level . " (" . ($mood->tags ?? '-') . ")\n";
        }



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
                    "3. Jika pengguna menunjukkan tanda-tanda ingin menyakiti diri sendiri atau bunuh diri, STOP percakapan dan berikan pesan berikut: 'Saya mendengar rasa sakitmu, tapi saya hanyalah AI. Tolong segera hubungi profesional atau layanan darurat di 119.'\n" .
                    "4. Jika kamu berpikir (thinking process), abaikan tag <think>...</think> di output akhir.\n" .
                    "5. Jaga jawaban tetap ringkas dan suportif.kecuali jika user meminta penjelasan lebih lanjut\n" .
                    "6. Jika pengguna merasa tidak puas dengan jawabanmu atau meminta ahli asli, beri tahu bahwa chat sudah diarahkan ke ahli asli. Berikan juga info bahwa layanan chat dengan ahli asli hanya tersedia dari jam 09.00 - 17.00.\n\n" .

                    "INSTRUKSI TAMBAHAN (GAYA KOMUNIKASI): \n" .
                    "7. Ulangi atau sebutkan kembali perasaan pengguna di awal kalimat agar mereka merasa dipedulikan.\n" .
                    "8. Jangan langsung memberikan solusi, lakukan validasi perasaan pengguna terlebih dahulu.\n" .
                    "9. Jangan menggunakan bahasa yang fleksibel atau berubah-ubah (tetap pertahankan gaya santai layaknya teman dari awal sampai akhir).\n" .
                    "10. Saat memberikan saran, berikan sebagai pilihan (opsi), BUKAN menyuruh atau memerintah pengguna untuk mencoba sesuatu.\n" .
                    "11. Jika pengguna pamit atau ingin menghentikan percakapan, berikan kalimat penutup yang menenangkan agar mereka merasa sedikit lebih tenang.\n\n" .
                    $moodContext,
            ]
        ];


        foreach ($history as $chat) {
            $messagesForAI[] = [
                'role' => $chat->is_user ? 'user' : 'assistant',
                'content' => $chat->message,
            ];
        }


        $messagesForAI[] = [
            'role' => 'user',
            'content' => $userMessage,
        ];



        $b64Key = getenv('GROQ_API_KEY_B64');
        $apiKey = !empty($b64Key) ? base64_decode($b64Key) : null;

        if (empty($apiKey)) {
            $secrets = @include(base_path('config/runtime_secrets.php'));
            $apiKey = (!empty($secrets['groq_key'])) ? $secrets['groq_key'] : null;
        }
        if (empty($apiKey))
            $apiKey = getenv('GROQ_API_KEY') ?: config('services.groq.key') ?: env('GROQ_API_KEY');

        if (empty($apiKey)) {
            Log::error('GROQ_API_KEY is missing or empty. Check Vercel Environment Variables.');
            $aiReply = "Maaf, kunci API AI belum dikonfigurasi. Mohon hubungi admin.";
        } else {
            try {

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


                $rawReply = $response->json()['choices'][0]['message']['content'];


                $aiReply = preg_replace('/<think>.*?<\/think>/s', '', $rawReply);
                $aiReply = trim($aiReply);

            } catch (\Exception $e) {
                Log::error('Chat Error: ' . $e->getMessage());

                $aiReply = "Maaf, terjadi error sistem: " . $e->getMessage();
            }
        }


        $botMessage = ChatMessage::create([
            'user_id' => $userId,
            'message' => $aiReply,
            'is_user' => false,
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


        return redirect()->route('chat.index');
    }


    public function clearChat()
    {
        ChatMessage::where('user_id', Auth::id())->delete();
        return redirect()->route('chat.index');
    }

    public function toggleMode(Request $request)
    {
        $currentMode = session('chat_mode', 'ai');
        $newMode = $currentMode === 'expert' ? 'ai' : 'expert';
        session(['chat_mode' => $newMode]);

        return redirect()->back();
    }
}