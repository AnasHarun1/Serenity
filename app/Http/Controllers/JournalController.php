<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class JournalController extends Controller
{
    // 1. Tampilkan Daftar Jurnal
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('journal.index', compact('journals'));
    }

    // 2. Tampilkan Form Tulis Jurnal
    public function create()
    {
        return view('journal.create');
    }

    // 3. Proses Simpan + Analisis AI
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // PERBAIKAN DI SINI: Gunakan input() agar tidak merah
        $content = $request->input('content');

        $summary = "Ringkasan tidak tersedia.";
        $sentiment = "Netral";

        // --- MULAI AI MAGIC ---
        $apiKey = env('GROQ_API_KEY');

        try {
            // Kita minta AI output JSON agar mudah diambil datanya
            $prompt = "Analisis jurnal curhatan ini: '$content'. \n" .
                "Berikan output format JSON murni tanpa markdown: {\"summary\": \"Buatkan ringkasan 1 kalimat pendek\", \"sentiment\": \"Positif/Negatif/Netral\"}";

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'response_format' => ['type' => 'json_object']
                ]);

            if ($response->successful()) {
                $responseText = $response->json()['choices'][0]['message']['content'];

                // Bersihkan format JSON (kadang AI kasih backticks ```json ...)
                $jsonString = str_replace(['```json', '```'], '', $responseText);
                $data = json_decode($jsonString, true);

                if ($data) {
                    $summary = $data['summary'] ?? $summary;
                    $sentiment = $data['sentiment'] ?? $sentiment;
                }
            }

        } catch (\Exception $e) {
            // Jika AI error, kita pakai default saja (potong 100 huruf pertama)
            $summary = substr($content, 0, 100) . '...';
        }
        // --- SELESAI AI ---

        Journal::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'), // Gunakan input() juga di sini
            'content' => $content,
            'ai_summary' => $summary,
            'detected_sentiment' => $sentiment,
        ]);

        return redirect()->route('journal.index')->with('success', 'Jurnal berhasil dianalisis AI!');
    }

    // 4. Lihat Detail Jurnal
    public function show($id)
    {
        $journal = Journal::where('user_id', Auth::id())->findOrFail($id);
        return view('journal.show', compact('journal'));
    }
}