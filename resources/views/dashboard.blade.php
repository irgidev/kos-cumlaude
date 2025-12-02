@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <i class="fas fa-user-friends fa-2x"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Total Penghuni Aktif</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPenghuni }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <i class="fas fa-door-open fa-2x"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Kamar Kosong</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $kamarKosong }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <i class="fas fa-tools fa-2x"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Laporan Aktif</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalLaporan }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Selamat Datang di Sistem Manajemen Kos</h2>
        <p class="text-gray-600">
            Anda login sebagai Staf. Gunakan menu di samping kiri untuk mengelola data penghuni, melihat status kamar, dan memantau pembayaran tagihan.
        </p>
        <div class="mt-4">
            <a href="{{ route('penghuni.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kelola Data Penghuni
            </a>
        </div>
    </div>
@endsection