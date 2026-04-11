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

    // 3. Proses Simpan
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $content = $request->input('content');

        Journal::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $content,
            'ai_summary' => null,
            'detected_sentiment' => null,
        ]);

        return redirect()->route('journal.index')->with('success', 'Jurnal berhasil disimpan!');
    }

    // 4. Lihat Detail Jurnal
    public function show($id)
    {
        $journal = Journal::where('user_id', Auth::id())->findOrFail($id);
        return view('journal.show', compact('journal'));
    }
}