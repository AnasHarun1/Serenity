<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;
use App\Models\DailyMission; // <--- Jangan lupa import ini
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http; // <--- Untuk konek ke AI

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil Mood Hari Ini
        $todayMood = Mood::where('user_id', $userId)
            ->whereDate('created_at', today())
            ->first();

        // ==========================================
        // FITUR BARU: Generate Misi Harian Otomatis
        // ==========================================

        // Cek apakah misi hari ini sudah ada di database?
        $dailyMission = DailyMission::where('user_id', $userId)
            ->whereDate('mission_date', today())
            ->first();

        // Jika BELUM ADA & User sudah isi mood (biar AI tau konteksnya), kita minta AI buatkan
        if (!$dailyMission && $todayMood) {

            // Siapkan data untuk AI
            $moodLabels = [1 => 'Buruk', 2 => 'Sedih', 3 => 'Biasa', 4 => 'Baik', 5 => 'Hebat'];
            $currentMood = $moodLabels[$todayMood->emoji_level];
            $cause = $todayMood->tags ?? 'Tidak spesifik';
            $apiKey = env('GROQ_API_KEY');

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

            try {
                // Tembak ke Groq
                $response = Http::withoutVerifying()
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type' => 'application/json'
                    ])
                    ->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model' => 'llama-3.3-70b-versatile',
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => "Kamu adalah asisten kesehatan mental. \n" . $moodContext . "\nUser memiliki streak check-in sebanyak " . (Auth::user()->streak ?? 0) . " hari."
                            ],
                            [
                                'role' => 'user',
                                'content' => "User sedang merasa '$currentMood' hari ini karena '$cause'. Berikan 1 kalimat pendek tugas/misi sederhana (max 15 kata) untuk memperbaiki mood dia hari ini sesuai konteks riwayatnya. Jangan pakai tanda kutip."
                            ]
                        ]
                    ]);

                // Ambil jawaban
                $missionText = $response->json()['choices'][0]['message']['content'];

                // Simpan ke Database (Supaya gak perlu request AI ulang seharian)
                $dailyMission = DailyMission::create([
                    'user_id' => $userId,
                    'mission_text' => $missionText,
                    'mission_date' => today(),
                    'is_completed' => false
                ]);

            } catch (\Exception $e) {
                // Fallback jika error/offline
                $dailyMission = new DailyMission();
                $dailyMission->mission_text = "Istirahatlah sejenak dan minum air putih.";
            }
        }
        // ==========================================

        // 2. Siapkan Data Grafik (7 Hari Terakhir)
        $moodHistory = Mood::where('user_id', $userId)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'asc')
            ->get();

        $chartLabels = $moodHistory->pluck('created_at')->map(fn($date) => $date->format('d M'))->toArray();
        $chartData = $moodHistory->pluck('emoji_level')->toArray();

        // 3. Statistik Penyebab
        $allTags = Mood::where('user_id', $userId)->pluck('tags')->toArray();
        $tagCounts = [];
        foreach ($allTags as $tagString) {
            if ($tagString) {
                $tags = explode(', ', $tagString);
                foreach ($tags as $tag) {
                    $tagCounts[$tag] = ($tagCounts[$tag] ?? 0) + 1;
                }
            }
        }
        arsort($tagCounts);
        $topTags = array_slice($tagCounts, 0, 5);

        return view('dashboard', compact('todayMood', 'chartLabels', 'chartData', 'topTags', 'dailyMission'));
    }
}