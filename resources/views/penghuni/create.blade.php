@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Registrasi Penghuni Baru</h2>

        <form action="{{ route('penghuni.store') }}" method="POST" x-data="{ tipe: 'Mahasiswa' }">
            @csrf
            
            <h3 class="font-bold text-gray-600 border-b mb-4 pb-1">Data Sewa & Kamar</h3>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Kamar Kosong</label>
                <select name="no_kamar" class="shadow border rounded w-full py-2 px-3 bg-white focus:outline-none focus:shadow-outline" required>
                    <option value="">-- Pilih Kamar --</option>
                    @foreach($kamarKosong as $k)
                        <option value="{{ $k->no_kamar }}">{{ $k->no_kamar }} ({{ $k->tipe }} - Rp {{ number_format($k->harga_sewa) }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="shadow border rounded w-full py-2 px-3" required>
            </div>

            <h3 class="font-bold text-gray-600 border-b mb-4 pb-1 mt-6">Data Pribadi</h3>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_penghuni" class="shadow border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
                <input type="text" name="no_telepon_penghuni" class="shadow border rounded w-full py-2 px-3" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="status_keaktifan" class="shadow border rounded w-full py-2 px-3">
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                </select>
            </div>

            <h3 class="font-bold text-gray-600 border-b mb-4 pb-1 mt-6">Kategori Penghuni</h3>
            <div class="flex gap-4 mb-4">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="jenis_penghuni" value="Mahasiswa" class="mr-2" onclick="document.getElementById('form-mhs').style.display='block'; document.getElementById('form-pkr').style.display='none';" checked>
                    Mahasiswa
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="jenis_penghuni" value="Pekerja" class="mr-2" onclick="document.getElementById('form-mhs').style.display='none'; document.getElementById('form-pkr').style.display='block';">
                    Pekerja
                </label>
            </div>

            <div id="form-mhs">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                    <input type="text" name="nim" class="shadow border rounded w-full py-2 px-3 bg-blue-50">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Universitas</label>
                    <input type="text" name="nama_universitas" class="shadow border rounded w-full py-2 px-3 bg-blue-50">
                </div>
            </div>

            <div id="form-pkr" style="display:none;">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="shadow border rounded w-full py-2 px-3 bg-green-50">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jabatan</label>
                    <input type="text" name="jabatan" class="shadow border rounded w-full py-2 px-3 bg-green-50">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded shadow hover:bg-blue-700 transition">Simpan & Tetapkan Kamar</button>
            </div>
        </form>
    </div>
@endsection