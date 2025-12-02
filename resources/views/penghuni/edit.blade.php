@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Penghuni</h2>

    <form action="{{ route('penghuni.update', $penghuni->id_penghuni) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="nama_penghuni" value="{{ $penghuni->nama_penghuni }}" class="shadow border rounded w-full py-2 px-3" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
            <input type="text" name="no_telepon_penghuni" value="{{ $penghuni->no_telepon_penghuni }}" class="shadow border rounded w-full py-2 px-3" required>
        </div>

        <!-- PILIHAN KAMAR (Desain disamakan dengan input lain) -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kamar Hunian</label>
            <select name="no_kamar" class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline bg-white">
                <option value="{{ $penghuni->no_kamar }}" selected>{{ $penghuni->no_kamar }} (Saat Ini)</option>
                @foreach($kamarKosong as $k)
                    <option value="{{ $k->no_kamar }}">{{ $k->no_kamar }} ({{ $k->tipe }} - Kosong)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status Keaktifan</label>
            <select name="status_keaktifan" class="shadow border rounded w-full py-2 px-3">
                <option value="Aktif" {{ $penghuni->status_keaktifan == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Non-Aktif" {{ $penghuni->status_keaktifan == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Data
            </button>
            <a href="{{ route('penghuni.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection