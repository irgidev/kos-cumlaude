@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Staf</h1>
    <a href="{{ route('staf.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Staf
    </a>
</div>

<div class="bg-white p-4 rounded shadow mb-4">
    <form action="{{ route('staf.index') }}" method="GET" class="flex gap-4">
        <select name="role" onchange="this.form.submit()" class="border p-2 rounded w-1/4 cursor-pointer">
            <option value="">Semua Peran</option>
            <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Teknisi" {{ request('role') == 'Teknisi' ? 'selected' : '' }}>Teknisi</option>
            <option value="Keamanan" {{ request('role') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
        </select>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / No Telp..." class="border p-2 rounded w-full">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Cari</button>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Nama Staf</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Peran</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">No. Telepon (Login)</th>
                <th class="px-5 py-3 border-b-2 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($staf as $s)
            <tr>
                <td class="px-5 py-5 border-b bg-white text-sm font-bold text-gray-900">{{ $s->nama_staf }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    @if($s->peran == 'Admin')
                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-bold">Admin</span>
                    @elseif($s->peran == 'Teknisi')
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Teknisi</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs font-bold">Keamanan</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm font-mono">{{ $s->no_telepon_staf }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm text-center">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('staf.edit', $s->id_staf) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('staf.destroy', $s->id_staf) }}" method="POST" onsubmit="return confirm('Hapus staf ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-5 text-gray-500">Belum ada data staf.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection