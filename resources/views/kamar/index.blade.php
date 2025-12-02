@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Kamar</h1>
    <a href="{{ route('kamar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">+ Tambah Kamar</a>
</div>

<!-- FILTER & SEARCH -->
<div class="bg-white p-4 rounded shadow mb-4">
    <form action="{{ route('kamar.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <select name="status" onchange="this.form.submit()" class="border p-2 rounded w-full md:w-1/4 focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Status</option>
            <option value="Kosong" {{ request('status') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
            <option value="Terisi" {{ request('status') == 'Terisi' ? 'selected' : '' }}>Terisi</option>
        </select>
        
        <div class="flex w-full md:w-3/4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No Kamar..." class="border p-2 rounded-l w-full focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r hover:bg-gray-700">Cari</button>
        </div>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">No Kamar</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Penghuni</th> <!-- KOLOM BARU -->
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Tipe</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Harga</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-5 py-3 border-b-2 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kamar as $k)
            <tr>
                <td class="px-5 py-5 border-b bg-white text-sm font-bold">{{ $k->no_kamar }}</td>
                <!-- TAMPILKAN NAMA PENGHUNI -->
                <td class="px-5 py-5 border-b bg-white text-sm">
                    @if($k->status_ketersediaan == 'Terisi' && $k->penghuni)
                        <span class="font-bold text-blue-600"><i class="fas fa-user mr-1"></i> {{ $k->penghuni->nama_penghuni }}</span>
                    @else
                        <span class="text-gray-400 italic">- Kosong -</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm">{{ $k->tipe }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm">Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    <span class="px-2 py-1 rounded {{ $k->status_ketersediaan == 'Kosong' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $k->status_ketersediaan }}
                    </span>
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm text-center">
                    <a href="{{ route('kamar.edit', $k->no_kamar) }}" class="text-blue-600 hover:text-blue-900 mx-2 font-bold">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection