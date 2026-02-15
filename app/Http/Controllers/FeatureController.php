<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mood;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{
    public function breathing()
    {
        return view('features.breathing');
    }

    public function music()
    {
        return view('features.music');
    }

    public function downloadReport()
    {
        $userId = Auth::id();
        $currentMonth = now()->format('m');
        $currentYear = now()->format('Y');

        // 1. Ambil Data Mood Bulan Ini
        $moods = Mood::where('user_id', $userId)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Ambil Jurnal Bulan Ini
        $journals = Journal::where('user_id', $userId)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Generate PDF
        // Kita kirim data ke view khusus PDF
        $pdf = Pdf::loadView('reports.monthly_pdf', compact('moods', 'journals'));

        // 4. Download file
        return $pdf->download('Laporan-Kesehatan-Mental-' . Auth::user()->name . '.pdf');
    }

    public function sos()
    {
        return view('features.sos');
    }
}
