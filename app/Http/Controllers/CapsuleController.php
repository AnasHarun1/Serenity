<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capsule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CapsuleController extends Controller
{
    public function index()
    {
        $capsules = Capsule::where('user_id', Auth::id())
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('capsule.index', compact('capsules'));
    }

    public function create()
    {
        return view('capsule.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_at' => 'required|date|after:today', 
        ]);

        Capsule::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->input('content'),
            'scheduled_at' => $request->scheduled_at,
            'is_read' => false,
        ]);

        return redirect()->route('capsule.index')->with('success', 'Kapsul waktu berhasil dikubur! ⏳');
    }

   
    public function show($id)
    {
        $capsule = Capsule::where('user_id', Auth::id())->findOrFail($id);

       
        if ($capsule->scheduled_at->isFuture()) {
            return redirect()->route('capsule.index')->with('error', 'Sabar ya! Belum waktunya membuka kapsul ini.');
        }

      
        if (!$capsule->is_read) {
            $capsule->update(['is_read' => true]);
        }

        return view('capsule.show', compact('capsule'));
    }
}