<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kos Cumlaude</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-800 p-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-white text-xl font-bold flex items-center gap-2">
                <i class="fas fa-building"></i> Kos Cumlaude
            </a>
            
            <div class="flex items-center gap-4">
                @if(Auth::guard('web')->check())
                    <span class="text-blue-200 text-sm hidden md:inline">Halo, {{ Auth::guard('web')->user()->nama_staf }}</span>
                @elseif(Auth::guard('penghuni')->check())
                    <span class="text-green-200 text-sm hidden md:inline">Halo, {{ Auth::guard('penghuni')->user()->nama_penghuni }}</span>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition shadow">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex h-screen overflow-hidden">
        @if(Auth::guard('web')->check())
        <div class="w-64 bg-white shadow-md hidden md:block flex-shrink-0 overflow-y-auto">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-blue-50 text-blue-800 font-semibold {{ request()->routeIs('dashboard') ? 'bg-blue-100' : '' }}">
                            <i class="fas fa-tachometer-alt w-6"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="px-2 pt-4 text-xs font-bold text-gray-400 uppercase">Master Data</li>
                    <li>
                        <a href="{{ route('staf.index') }}" class="block p-2 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-800 {{ request()->routeIs('staf.*') ? 'bg-blue-50 font-bold text-blue-800' : '' }}">
                            <i class="fas fa-user-shield w-6"></i> Data Staf
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penghuni.index') }}" class="block p-2 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-800 {{ request()->routeIs('penghuni.*') ? 'bg-blue-50 font-bold text-blue-800' : '' }}">
                            <i class="fas fa-users w-6"></i> Penghuni
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kamar.index') }}" class="block p-2 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-800 {{ request()->routeIs('kamar.*') ? 'bg-blue-50 font-bold text-blue-800' : '' }}">
                            <i class="fas fa-bed w-6"></i> Data Kamar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('fasilitas.index') }}" class="block p-2 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-800 {{ request()->routeIs('fasilitas.*') ? 'bg-blue-50 font-bold text-blue-800' : '' }}">
                            <i class="fas fa-couch w-6"></i> Data Fasilitas
                        </a>
                    </li>

                    <li class="px-2 pt-4 text-xs font-bold text-gray-400 uppercase">Transaksi & Layanan</li>
                    <li>
                        <a href="{{ route('tagihan.index') }}" class="block p-2 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-800 {{ request()->routeIs('tagihan.*') ? 'bg-blue-50 font-bold text-blue-800' : '' }}">
                            <i class="fas fa-file-invoice-dollar w-6"></i> Pembayaran Sewa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.index') }}" class="block p-2 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-800 {{ request()->routeIs('laporan.*') ? 'bg-blue-50 font-bold text-blue-800' : '' }}">
                            <i class="fas fa-tools w-6"></i> Laporan Kerusakan
                        </a>
                    </li>

                    <li class="px-2 pt-4 text-xs font-bold text-gray-400 uppercase">Laporan</li>
                    <li>
                        <a href="{{ route('rekap.index') }}" class="block p-2 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-800 {{ request()->routeIs('rekap.*') ? 'bg-blue-50 font-bold text-blue-800' : '' }}">
                            <i class="fas fa-chart-line w-6"></i> Rekap Keuangan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif

        <div class="flex-1 overflow-y-auto p-6 bg-gray-100">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 shadow-sm rounded" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 shadow-sm rounded" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
            
            <div class="mt-8 pt-4 border-t border-gray-300 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Sistem Informasi Manajemen Kos Cumlaude. Kelompok 7.
            </div>
        </div>
    </div>

</body>
</html>