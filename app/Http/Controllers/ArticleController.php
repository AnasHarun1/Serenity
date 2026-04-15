<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Mood;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth::user();

        
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


        $query = Article::query();


        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {

                $q->whereRaw('LOWER(title) LIKE LOWER(?)', ['%' . $search . '%'])
                    ->orWhereRaw('LOWER(content) LIKE LOWER(?)', ['%' . $search . '%'])
                    ->orWhereRaw('LOWER(category) LIKE LOWER(?)', ['%' . $search . '%']);
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if (!$request->filled('search') && !$request->filled('category')) {
            $query->orderByRaw("CASE WHEN mood_tag = '$recommendationTag' THEN 1 ELSE 2 END");
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $articles = $query->get();
        $categories = Article::select('category')->distinct()->pluck('category');

        return view('library.index', compact('articles', 'contextMessage', 'categories', 'recommendationTag'));
    }
    
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('library.show', compact('article'));
    }
}