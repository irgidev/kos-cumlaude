@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Catat Tagihan Baru</h2>

    <form action="{{ route('tagihan.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Penghuni</label>
            <select name="id_penghuni" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">-- Pilih Penghuni Aktif --</option>
                @foreach($penghuni as $p)
                    <option value="{{ $p->id_penghuni }}">{{ $p->nama_penghuni }} ({{ $p->no_telepon_penghuni }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Periode Tagihan</label>
            <input type="text" name="periode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Desember 2025" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nominal (Rp)</label>
            <input type="number" name="nominal_tagihan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: 850000" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status Pembayaran</label>
            <select name="status_bayar" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Tunggak">Tunggak (Belum Bayar)</option>
                <option value="Lunas">Lunas (Sudah Bayar)</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Tagihan
            </button>
            <a href="{{ route('tagihan.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection