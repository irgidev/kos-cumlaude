<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\Kamar;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenghuni = Penghuni::where('status_keaktifan', 'Aktif')->count();
        $kamarKosong = Kamar::where('status_ketersediaan', 'Kosong')->count();
        
        $totalLaporan = DB::table('laporan_kerusakan')->where('status_laporan', '!=', 'Selesai')->count();

        return view('dashboard', compact('totalPenghuni', 'kamarKosong', 'totalLaporan'));
    }
}