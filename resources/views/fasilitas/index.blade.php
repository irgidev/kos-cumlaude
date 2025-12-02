@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Fasilitas</h1>
    <a href="{{ route('fasilitas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Fasilitas
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Fasilitas</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lokasi Kamar</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kondisi</th>
                <th class="px-5 py-3 border-b-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fasilitas as $index => $f)
            <tr>
                <td class="px-5 py-5 border-b bg-white text-sm">{{ $index + 1 }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm font-bold text-gray-800">{{ $f->nama_fasilitas }}</td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    <span class="bg-blue-100 text-blue-800 py-1 px-2 rounded text-xs font-bold">
                        {{ $f->no_kamar }}
                    </span>
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    @if($f->kondisi == 'Baik')
                        <span class="text-green-600 font-bold bg-green-100 px-2 py-1 rounded-full text-xs">Baik</span>
                    @elseif($f->kondisi == 'Rusak')
                        <span class="text-red-600 font-bold bg-red-100 px-2 py-1 rounded-full text-xs">Rusak</span>
                    @else
                        <span class="text-yellow-600 font-bold bg-yellow-100 px-2 py-1 rounded-full text-xs">Perbaikan</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm text-center">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('fasilitas.edit', $f->id_fasilitas) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('fasilitas.destroy', $f->id_fasilitas) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-5 text-gray-500">Belum ada data fasilitas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection