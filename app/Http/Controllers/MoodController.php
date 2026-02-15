<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    // 1. Tampilkan Halaman Input Mood
    public function create()
    {
        // Cek apakah hari ini sudah isi mood? (Opsional, biar tidak dobel)
        $todayMood = Mood::where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->first();

        return view('mood.create', compact('todayMood'));
    }

    // 2. Simpan Mood ke Database
    public function store(Request $request)
    {
        $request->validate([
            'emoji_level' => 'required|integer|min:1|max:5',
            'tags' => 'nullable|array',
            'description' => 'nullable|string|max:255',
        ]);

        $tagsString = $request->tags ? implode(', ', $request->tags) : null;
        $user = Auth::user(); // Ambil user yg sedang login

        // 1. Simpan Mood
        Mood::create([
            'user_id' => $user->id,
            'emoji_level' => $request->emoji_level,
            'tags' => $tagsString,
            'description' => $request->description,
        ]);

        // 2. LOGIKA STREAK (Gamifikasi) 🔥
        $today = now()->format('Y-m-d');
        $yesterday = now()->subDay()->format('Y-m-d');

        // Cek apakah hari ini belum check-in (biar gak nambah kalau spam submit)
        if ($user->last_checkin !== $today) {

            if ($user->last_checkin === $yesterday) {
                // Kalau check-in terakhir adalah kemarin, TAMBAH STREAK
                $user->increment('streak');
            } else {
                // Kalau bolong sehari atau baru mulai, RESET jadi 1
                $user->streak = 1;
            }

            // Update tanggal check-in terakhir
            $user->last_checkin = $today;
            $user->save();
        }

        return redirect()->route('dashboard')->with('success', 'Mood tersimpan! Streak kamu bertambah 🔥');
    }
}