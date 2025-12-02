@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Riwayat Pembayaran</h1>
    <a href="{{ route('tagihan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">+ Catat Tagihan</a>
</div>

<!-- FILTER & SEARCH -->
<div class="bg-white p-4 rounded shadow mb-4">
    <form action="{{ route('tagihan.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <select name="status" onchange="this.form.submit()" class="border p-2 rounded w-full md:w-1/4 focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Status</option>
            <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
            <option value="Tunggak" {{ request('status') == 'Tunggak' ? 'selected' : '' }}>Tunggak</option>
        </select>
        
        <div class="flex w-full md:w-3/4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Penghuni..." class="border p-2 rounded-l w-full focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r hover:bg-gray-700">Cari</button>
        </div>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Periode</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Penghuni</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Nominal</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-5 py-3 border-b-2 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tagihan as $t)
            <tr>
                <td class="px-5 py-5 border-b bg-white text-sm">{{ $t->periode }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm font-bold">{{ $t->penghuni->nama_penghuni ?? '-' }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm">Rp {{ number_format($t->nominal_tagihan, 0, ',', '.') }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    <span class="px-2 py-1 rounded {{ $t->status_bayar == 'Lunas' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $t->status_bayar }}
                    </span>
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm text-center">
                    <a href="{{ route('tagihan.edit', $t->id_tagihan) }}" class="text-blue-600 hover:text-blue-900 font-bold">Update Status</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection