@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Status Pembayaran</h2>

    <form action="{{ route('tagihan.update', $tagihan->id_tagihan) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Info Penghuni (Readonly) -->
        <div class="mb-4 bg-blue-50 p-4 rounded border border-blue-200">
            <p class="text-sm text-gray-600">Nama Penghuni:</p>
            <p class="font-bold text-lg text-gray-800">{{ $tagihan->penghuni->nama_penghuni ?? 'Penghuni Terhapus' }}</p>
            <p class="text-sm text-gray-600 mt-2">Periode:</p>
            <p class="font-bold text-gray-800">{{ $tagihan->periode }}</p>
            
            <!-- Hidden Fields agar data lama tidak hilang -->
            <input type="hidden" name="id_penghuni" value="{{ $tagihan->id_penghuni }}">
            <input type="hidden" name="periode" value="{{ $tagihan->periode }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nominal Tagihan (Rp)</label>
            <input type="number" name="nominal_tagihan" value="{{ $tagihan->nominal_tagihan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status Pembayaran</label>
            <select name="status_bayar" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Tunggak" {{ $tagihan->status_bayar == 'Tunggak' ? 'selected' : '' }}>Tunggak (Belum Lunas)</option>
                <option value="Lunas" {{ $tagihan->status_bayar == 'Lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Status
            </button>
            <a href="{{ route('tagihan.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection