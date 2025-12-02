@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Penghuni</h1>
    <a href="{{ route('penghuni.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Penghuni
    </a>
</div>

<div class="bg-white p-4 rounded shadow mb-4">
    <form action="{{ route('penghuni.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <select name="jenis" onchange="this.form.submit()" class="border p-2 rounded w-full md:w-1/4 focus:ring-2 focus:ring-blue-500 cursor-pointer">
            <option value="">Semua Kategori</option>
            <option value="Mahasiswa" {{ request('jenis') == 'Mahasiswa' ? 'selected' : '' }}>🎓 Mahasiswa</option>
            <option value="Pekerja" {{ request('jenis') == 'Pekerja' ? 'selected' : '' }}>💼 Pekerja</option>
        </select>

        <select name="status" onchange="this.form.submit()" class="border p-2 rounded w-full md:w-1/4 focus:ring-2 focus:ring-blue-500 cursor-pointer">
            <option value="">Semua Status</option>
            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
        </select>
        
        <div class="flex w-full md:w-2/4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Penghuni..." class="border p-2 rounded-l w-full focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r hover:bg-gray-700">Cari</button>
        </div>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Kamar</th> <!-- KOLOM BARU -->
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Nama Penghuni</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Kategori & Detail</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Kontak</th>
                <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-5 py-3 border-b-2 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penghuni as $p)
            <tr>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    @if($p->no_kamar)
                        <span class="bg-blue-600 text-white py-1 px-3 rounded font-bold text-md shadow">{{ $p->no_kamar }}</span>
                    @else
                        <span class="text-gray-400 italic">Belum ada</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    <p class="font-bold text-gray-900">{{ $p->nama_penghuni }}</p>
                    <p class="text-xs text-gray-500">Masuk: {{ $p->tanggal_masuk }}</p>
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    @if($p->mahasiswa)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 mb-1">🎓 Mahasiswa</span>
                        <div class="text-xs text-gray-600"><span class="font-semibold">{{ $p->mahasiswa->nama_universitas }}</span><br>NIM: {{ $p->mahasiswa->nim }}</div>
                    @elseif($p->pekerja)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mb-1">💼 Pekerja</span>
                        <div class="text-xs text-gray-600"><span class="font-semibold">{{ $p->pekerja->nama_perusahaan }}</span><br>Jabatan: {{ $p->pekerja->jabatan }}</div>
                    @else
                        <span class="text-gray-400 text-xs">- Tidak ada data detail -</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    <i class="fas fa-phone-alt text-gray-400 text-xs mr-1"></i> {{ $p->no_telepon_penghuni }}
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm">
                    @if($p->status_keaktifan == 'Aktif')
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full text-xs">Aktif</span>
                    @else
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full text-xs">Non-Aktif</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b bg-white text-sm text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('penghuni.edit', $p->id_penghuni) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('penghuni.destroy', $p->id_penghuni) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-5 text-gray-500">Tidak ada data penghuni.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection