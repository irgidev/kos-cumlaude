@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg border-t-4 border-red-500 mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Form Lapor Kerusakan</h2>
    
    @if(!$no_kamar)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
            <p>Anda belum terdaftar di kamar manapun. Hubungi admin.</p>
        </div>
    @else
        <p class="text-gray-600 mb-6 text-sm">Laporkan kerusakan di kamar Anda <strong>({{ $no_kamar }})</strong>.</p>

        <form action="{{ route('penghuni.laporan.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="id_penghuni" value="{{ $penghuni->id_penghuni }}">
            <input type="hidden" name="no_kamar" value="{{ $no_kamar }}">
            <input type="hidden" name="status_laporan" value="Dilaporkan">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Fasilitas yang Bermasalah</label>
                <select name="id_fasilitas" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">-- Pilih Objek Kerusakan --</option>
                    @foreach($fasilitas as $f)
                        <option value="{{ $f->id_fasilitas }}">{{ $f->nama_fasilitas }} (Kondisi: {{ $f->kondisi }})</option>
                    @endforeach
                    <option value="lainnya">Lainnya (Bukan Fasilitas Terdaftar)</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Detail Kerusakan / Keluhan</label>
                <textarea name="deskripsi_tambahan" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: AC tidak dingin, keran patah, dll..." required></textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline shadow-lg transition">
                    Kirim Laporan
                </button>
                <a href="{{ route('dashboard.penghuni') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    @endif
</div>
@endsection