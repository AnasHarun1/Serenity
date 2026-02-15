<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Mood;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // 1. Halaman Utama Pustaka (Rekomendasi)
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. Cek Mood Terakhir (Untuk Teks Sapaan)
        $lastMood = Mood::where('user_id', $user->id)->latest()->first();
        $contextMessage = "Menambah wawasan harianmu.";
        $recommendationTag = 'neutral';

        if ($lastMood) {
            if ($lastMood->emoji_level <= 2) {
                $recommendationTag = 'sad';
                $contextMessage = "Kami siapkan bacaan untuk menenangkan pikiranmu.";
            } elseif ($lastMood->emoji_level == 3) {
                $recommendationTag = 'neutral';
                $contextMessage = "Tips ringan untuk meningkatkan kualitas hidup.";
            } else {
                $recommendationTag = 'happy';
                $contextMessage = "Manfaatkan energi positifmu hari ini!";
            }
        }

        // 2. Logika Query (Search & Filter)
        $query = Article::query();

        // PERBAIKAN DI SINI: Pencarian Lebih Luas (Judul ATAU Isi ATAU Kategori)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        // Jika ada filter kategori (tombol pill diklik)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Urutkan: Jika sedang mencari, urutkan terbaru. Jika tidak, urutkan rekomendasi mood dulu.
        if (!$request->filled('search') && !$request->filled('category')) {
            $query->orderByRaw("CASE WHEN mood_tag = '$recommendationTag' THEN 1 ELSE 2 END");
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $articles = $query->get();

        // Ambil daftar kategori unik untuk tombol filter
        $categories = Article::select('category')->distinct()->pluck('category');

        return view('library.index', compact('articles', 'contextMessage', 'categories', 'recommendationTag'));
    }
    // 2. Baca Detail Artikel
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('library.show', compact('article'));
    }
}