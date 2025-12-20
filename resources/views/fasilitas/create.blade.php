@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Fasilitas Baru</h2>

    <form action="{{ route('fasilitas.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Fasilitas</label>
            <select name="nama_fasilitas" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">-- Pilih Jenis Fasilitas --</option>
                <option value="Kasur">Kasur</option>
                <option value="Lemari">Lemari</option>
                <option value="Meja">Meja</option>
                <option value="Kursi">Kursi</option>
                <option value="Kipas Angin">Kipas Angin</option>
                <option value="AC">AC</option>
                <option value="TV">TV</option>
                <option value="Kulkas">Kulkas</option>
                <option value="Water Heater">Water Heater</option>
                <option value="Sofa">Sofa</option>
                <option value="Cermin">Cermin</option>
                <option value="Gorden">Gorden</option>
                <option value="Lampu">Lampu</option>
                <option value="Rak Sepatu">Rak Sepatu</option>
                <option value="Jemuran Handuk">Jemuran Handuk</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi Kamar</label>
            <select name="no_kamar" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">-- Pilih Kamar --</option>
                @foreach($kamar as $k)
                    <option value="{{ $k->no_kamar }}">{{ $k->no_kamar }} ({{ $k->tipe }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kondisi Awal</label>
            <select name="kondisi" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="Perbaikan">Perbaikan</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Fasilitas
            </button>
            <a href="{{ route('fasilitas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection