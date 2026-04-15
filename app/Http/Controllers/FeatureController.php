<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mood;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{

    public function downloadReport()
    {
        $userId = Auth::id();
        $currentMonth = now()->format('m');
        $currentYear = now()->format('Y');

       
        $moods = Mood::where('user_id', $userId)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->get();

       
        $journals = Journal::where('user_id', $userId)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc')
            ->get();

        
        $pdf = Pdf::loadView('reports.monthly_pdf', compact('moods', 'journals'));

    
        return $pdf->download('Laporan-Kesehatan-Mental-' . Auth::user()->name . '.pdf');
    }

    public function sos()
    {
        return view('features.sos');
    }
}
