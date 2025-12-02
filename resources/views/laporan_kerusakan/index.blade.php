@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Laporan Kerusakan</h1>
</div>

<!-- FILTER STATUS -->
<div class="bg-white p-4 rounded shadow mb-6 border-l-4 border-blue-500">
    <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4">
        <div class="flex items-center gap-2 w-full md:w-auto">
            <i class="fas fa-filter text-gray-500"></i>
            <span class="font-bold text-gray-700">Filter Status:</span>
        </div>
        
        <select name="status" onchange="this.form.submit()" class="border p-2 rounded w-full md:w-1/4 focus:ring-2 focus:ring-blue-500 cursor-pointer">
            <option value="">Semua Laporan</option>
            <option value="Dilaporkan" {{ request('status') == 'Dilaporkan' ? 'selected' : '' }}>🚩 Dilaporkan (Baru)</option>
            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>🛠️ Sedang Proses</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
        </select>

        @if(request('status'))
            <a href="{{ route('laporan.index') }}" class="text-sm text-red-500 hover:underline ml-2">Reset Filter</a>
        @endif
    </form>
</div>

<!-- GRID DATA LAPORAN -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($laporan as $l)
    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition border-l-4 {{ $l->status_laporan == 'Selesai' ? 'border-green-500' : ($l->status_laporan == 'Proses' ? 'border-yellow-500' : 'border-red-500') }}">
        
        <div class="flex justify-between items-start mb-2">
            <div>
                <h3 class="font-bold text-lg text-gray-800">{{ $l->kamar->no_kamar ?? 'Kamar ???' }}</h3>
                <span class="text-xs text-gray-500">{{ date('d M Y, H:i', strtotime($l->tanggal_lapor)) }}</span>
            </div>
            <!-- Badge Status -->
            <span class="text-xs font-bold px-2 py-1 rounded border {{ $l->status_laporan == 'Selesai' ? 'bg-green-100 text-green-700 border-green-200' : ($l->status_laporan == 'Proses' ? 'bg-yellow-100 text-yellow-700 border-yellow-200' : 'bg-red-100 text-red-700 border-red-200') }}">
                {{ $l->status_laporan }}
            </span>
        </div>

        <p class="text-sm font-semibold text-blue-600 mb-2">
            <i class="fas fa-user-circle mr-1"></i> {{ $l->penghuni->nama_penghuni ?? 'Anonim' }}
        </p>
        
        <div class="bg-gray-50 p-3 rounded border border-gray-100 mb-4">
            <p class="text-gray-700 text-sm italic">"{{ $l->deskripsi }}"</p>
        </div>
        
        <div class="flex justify-end items-center mt-auto pt-4 border-t border-gray-100">
            <a href="{{ route('laporan.edit', $l->id_laporan) }}" class="bg-blue-600 text-white text-sm font-bold px-3 py-2 rounded hover:bg-blue-700 transition shadow">
                <i class="fas fa-edit mr-1"></i> Tindak Lanjut
            </a>
        </div>

        @if($l->staf)
        <div class="mt-3 text-xs text-gray-500 text-center">
            Ditangani oleh: <strong>{{ $l->staf->nama_staf }}</strong>
        </div>
        @endif
    </div>
    @empty
    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 bg-white rounded shadow-sm border border-dashed border-gray-300">
        <i class="fas fa-clipboard-check text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500">Tidak ada laporan dengan status ini.</p>
    </div>
    @endforelse
</div>
@endsection