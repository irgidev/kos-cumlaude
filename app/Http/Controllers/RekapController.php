<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function index()
    {
        $pendapatan = DB::table('tagihan')
            ->select('periode', DB::raw('SUM(nominal_tagihan) as total'))
            ->where('status_bayar', 'Lunas')
            ->groupBy('periode')
            ->get();

        $tunggakan = DB::table('tagihan')
            ->join('penghuni', 'tagihan.id_penghuni', '=', 'penghuni.id_penghuni')
            ->select('penghuni.nama_penghuni', 'tagihan.periode', 'tagihan.nominal_tagihan')
            ->where('tagihan.status_bayar', 'Tunggak')
            ->orderBy('tagihan.periode', 'asc')
            ->get();

        $kamarKosong = DB::table('kamar')
            ->where('status_ketersediaan', 'Kosong')
            ->orderBy('no_kamar', 'asc')
            ->get();

        return view('rekap.index', compact('pendapatan', 'tunggakan', 'kamarKosong'));
    }
}