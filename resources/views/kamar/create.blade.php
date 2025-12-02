@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Data Kamar</h2>

    <form action="{{ route('kamar.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">No. Kamar</label>
            <input type="text" name="no_kamar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: A101" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Kamar</label>
            <select name="tipe" id="tipe_kamar" onchange="updateHarga()" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Standard">Standard</option>
                <option value="VIP">VIP</option>
                <option value="VVIP">VVIP</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Harga Sewa (Rp)</label>
            <!-- Input Harga Readonly Tanpa Note -->
            <input type="number" id="harga_sewa" name="harga_sewa" value="750000" class="bg-gray-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status Awal</label>
            <select name="status_ketersediaan" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Kosong">Kosong</option>
                <option value="Terisi">Terisi</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Kamar
            </button>
            <a href="{{ route('kamar.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>

    <script>
        function updateHarga() {
            const tipe = document.getElementById('tipe_kamar').value;
            const inputHarga = document.getElementById('harga_sewa');
            
            if(tipe === 'Standard') inputHarga.value = 750000;
            else if(tipe === 'VIP') inputHarga.value = 850000;
            else if(tipe === 'VVIP') inputHarga.value = 1000000;
        }
    </script>
</div>
@endsection