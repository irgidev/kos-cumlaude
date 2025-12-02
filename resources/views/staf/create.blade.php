@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Staf Baru</h2>

    <form action="{{ route('staf.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="nama_staf" class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Peran / Jabatan</label>
            <select name="peran" class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline" required>
                <option value="Admin">Admin</option>
                <option value="Teknisi">Teknisi</option>
                <option value="Keamanan">Keamanan</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon (Digunakan sebagai Password)</label>
            <input type="number" name="no_telepon_staf" class="shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Staf
            </button>
            <a href="{{ route('staf.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection