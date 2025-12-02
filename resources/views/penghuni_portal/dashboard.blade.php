<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Penghuni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-800 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="font-bold text-xl flex items-center gap-2">
                <i class="fas fa-home"></i> Portal Penghuni
            </div>
            <div class="flex items-center gap-4">
                <span>Halo, {{ Auth::guard('penghuni')->user()->nama_penghuni }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm transition shadow">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        
        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow rounded" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Card Lapor Kerusakan -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-t-4 border-red-500">
                <div class="text-red-500 text-4xl mb-4"><i class="fas fa-hammer"></i></div>
                <h2 class="text-xl font-bold mb-2 text-gray-800">Lapor Kerusakan</h2>
                <p class="text-gray-600 mb-4">Ada fasilitas yang rusak? Laporkan segera di sini agar diperbaiki teknisi.</p>
                <a href="{{ route('penghuni.laporan.create') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 shadow">Buat Laporan</a>
            </div>

            <!-- Card Tagihan Saya -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-t-4 border-blue-500">
                <div class="text-blue-600 text-4xl mb-4"><i class="fas fa-file-invoice-dollar"></i></div>
                <h2 class="text-xl font-bold mb-2 text-gray-800">Tagihan Saya</h2>
                <p class="text-gray-600 mb-4">Cek riwayat pembayaran sewa dan status tagihan bulanan Anda.</p>
                <a href="{{ route('penghuni.tagihan') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">Lihat Tagihan</a>
            </div>
        </div>

        <!-- RIWAYAT LAPORAN KERUSAKAN -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-700 text-lg"><i class="fas fa-history mr-2"></i> Riwayat Laporan Saya</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi & Kerusakan</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Teknisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatLaporan as $laporan)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-5 py-4 text-sm bg-white">
                                {{ date('d M Y', strtotime($laporan->tanggal_lapor)) }}
                            </td>
                            <td class="px-5 py-4 text-sm bg-white">
                                <p class="font-bold text-gray-800">{{ $laporan->kamar->no_kamar ?? '-' }}</p>
                                <p class="text-gray-600 italic text-xs">{{ Str::limit($laporan->deskripsi, 50) }}</p>
                            </td>
                            <td class="px-5 py-4 text-sm bg-white">
                                @if($laporan->status_laporan == 'Dilaporkan')
                                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Dilaporkan</span>
                                @elseif($laporan->status_laporan == 'Proses')
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">Proses</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Selesai</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-sm bg-white text-gray-600">
                                {{ $laporan->staf->nama_staf ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-gray-500 bg-white">
                                Belum ada riwayat laporan kerusakan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>