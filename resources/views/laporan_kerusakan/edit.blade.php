@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border-t-4 border-yellow-500">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tindak Lanjut Laporan Kerusakan</h2>

    <div class="mb-6 p-4 bg-gray-50 rounded border">
        <h3 class="font-bold text-gray-700 mb-2">Detail Laporan:</h3>
        <p><strong>Kamar:</strong> {{ $laporan->no_kamar }}</p>
        <p><strong>Pelapor:</strong> {{ $laporan->penghuni->nama_penghuni ?? '-' }}</p>
        <p><strong>Keluhan:</strong> {{ $laporan->deskripsi }}</p>
        <p class="text-xs text-gray-500 mt-2">Dilaporkan pada: {{ $laporan->tanggal_lapor }}</p>
    </div>

    <form action="{{ route('laporan.update', $laporan->id_laporan) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Input Hidden untuk data yang tidak berubah -->
        <input type="hidden" name="id_penghuni" value="{{ $laporan->id_penghuni }}">
        <input type="hidden" name="no_kamar" value="{{ $laporan->no_kamar }}">
        <input type="hidden" name="deskripsi" value="{{ $laporan->deskripsi }}">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Update Status Pengerjaan</label>
            <select name="status_laporan" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Dilaporkan" {{ $laporan->status_laporan == 'Dilaporkan' ? 'selected' : '' }}>Dilaporkan (Belum diproses)</option>
                <option value="Proses" {{ $laporan->status_laporan == 'Proses' ? 'selected' : '' }}>Sedang Diproses/Diperbaiki</option>
                <option value="Selesai" {{ $laporan->status_laporan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tugaskan Teknisi</label>
            <select name="id_staf" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">-- Pilih Teknisi --</option>
                @foreach($staf as $s)
                    <option value="{{ $s->id_staf }}" {{ $laporan->id_staf == $s->id_staf ? 'selected' : '' }}>
                        {{ $s->nama_staf }} ({{ $s->no_telepon_staf }})
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">*Pilih staf teknisi yang akan menangani perbaikan ini.</p>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Progress
            </button>
            <a href="{{ route('laporan.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection