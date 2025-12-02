@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Laporan & Rekapitulasi</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <!-- 1. Laporan Pendapatan -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4 border-b pb-2">Pendapatan Bulanan (Lunas)</h3>
        <table class="w-full text-sm">
            <tr class="bg-gray-100"><th class="p-2 text-left">Periode</th><th class="p-2 text-right">Total</th></tr>
            @foreach($pendapatan as $p)
            <tr>
                <td class="p-2 border-b">{{ $p->periode }}</td>
                <td class="p-2 border-b text-right font-mono text-green-700">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- 2. Laporan Tunggakan -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4 border-b pb-2 text-red-600">Daftar Tunggakan Penghuni</h3>
        <ul class="space-y-3">
            @foreach($tunggakan as $t)
            <li class="flex justify-between items-center border-b pb-2">
                <div>
                    <div class="font-bold">{{ $t->nama_penghuni }}</div>
                    <div class="text-xs text-gray-500">{{ $t->periode }}</div>
                </div>
                <div class="font-mono text-red-600">Rp {{ number_format($t->nominal_tagihan, 0, ',', '.') }}</div>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- 3. Laporan Kamar Kosong -->
    <div class="bg-white p-6 rounded shadow md:col-span-2">
        <h3 class="text-lg font-bold mb-4 border-b pb-2">Daftar Kamar Tersedia (Kosong)</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($kamarKosong as $k)
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded border border-green-300">
                <span class="font-bold block">{{ $k->no_kamar }}</span>
                <span class="text-xs">{{ $k->tipe }} - Rp {{ number_format($k->harga_sewa/1000, 0) }}k</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection