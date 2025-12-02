@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Fasilitas</h2>

    <form action="{{ route('fasilitas.update', $fasilitas->id_fasilitas) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Fasilitas</label>
            <input type="text" name="nama_fasilitas" value="{{ $fasilitas->nama_fasilitas }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi Kamar</label>
            <select name="no_kamar" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($kamar as $k)
                    <option value="{{ $k->no_kamar }}" {{ $fasilitas->no_kamar == $k->no_kamar ? 'selected' : '' }}>
                        {{ $k->no_kamar }} ({{ $k->tipe }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kondisi Saat Ini</label>
            <select name="kondisi" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Baik" {{ $fasilitas->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak" {{ $fasilitas->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="Perbaikan" {{ $fasilitas->kondisi == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Data
            </button>
            <a href="{{ route('fasilitas.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection