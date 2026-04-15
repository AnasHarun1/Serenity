<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{

    public function create()
    {

        $todayMood = Mood::where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->first();

        return view('mood.create', compact('todayMood'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'emoji_level' => 'required|integer|min:1|max:5',
            'tags' => 'nullable|array',
            'description' => 'nullable|string|max:255',
        ]);

        $tagsString = $request->tags ? implode(', ', $request->tags) : null;
        $user = Auth::user();


        Mood::create([
            'user_id' => $user->id,
            'emoji_level' => $request->emoji_level,
            'tags' => $tagsString,
            'description' => $request->description,
        ]);


        $today = now()->format('Y-m-d');
        $yesterday = now()->subDay()->format('Y-m-d');


        if ($user->last_checkin !== $today) {
            if ($user->last_checkin === $yesterday) {
                $user->increment('streak');
            } else {
                $user->streak = 1;
            }
            $user->last_checkin = $today;
            $user->save();
        }

        return redirect()->route('dashboard')->with('success', 'Mood tersimpan! Streak kamu bertambah 🔥');
    }
}