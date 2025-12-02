<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Saya - Kos Cumlaude</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- AlpineJS untuk interaksi modal sederhana -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100" x-data="{ showQris: false, showReceipt: false, nominal: 0, receiptData: {} }">

    <nav class="bg-blue-800 p-4 text-white shadow-lg mb-8">
        <div class="container mx-auto flex justify-between items-center">
            <div class="font-bold text-xl"><i class="fas fa-file-invoice-dollar"></i> Tagihan Saya</div>
            <a href="{{ route('dashboard.penghuni') }}" class="text-sm bg-blue-700 px-3 py-1 rounded hover:bg-blue-900">Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container mx-auto p-4 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 bg-blue-50 border-b border-blue-100">
                <h2 class="text-xl font-bold text-blue-800">Riwayat Pembayaran</h2>
                <p class="text-gray-600 text-sm">Berikut adalah daftar tagihan sewa Anda.</p>
            </div>
            
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Periode</th>
                        <th class="px-5 py-3 border-b-2 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase">Nominal</th>
                        <th class="px-5 py-3 border-b-2 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase">Status & Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihan as $t)
                    <tr>
                        <td class="px-5 py-5 border-b bg-white text-sm">
                            <p class="text-gray-900 font-bold">{{ $t->periode }}</p>
                        </td>
                        <td class="px-5 py-5 border-b bg-white text-sm text-right">
                            <p class="text-gray-900 font-mono">Rp {{ number_format($t->nominal_tagihan, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-5 py-5 border-b bg-white text-sm text-center">
                            @if($t->status_bayar == 'Lunas')
                                <div class="flex flex-col items-center gap-2">
                                    <span class="px-3 py-1 text-xs font-semibold text-green-900 bg-green-200 rounded-full">LUNAS</span>
                                    <!-- TOMBOL LIHAT KWITANSI (STYLE MIRIP BAYAR) -->
                                    <button @click="showReceipt = true; receiptData = { periode: '{{ $t->periode }}', nominal: '{{ number_format($t->nominal_tagihan, 0, ',', '.') }}' }" 
                                            class="bg-green-600 text-white text-xs font-bold px-3 py-1.5 rounded hover:bg-green-700 shadow flex items-center gap-1 transition">
                                        <i class="fas fa-receipt"></i> Lihat Kwitansi
                                    </button>
                                </div>
                            @else
                                <div class="flex flex-col items-center gap-2">
                                    <span class="px-3 py-1 text-xs font-semibold text-red-900 bg-red-200 rounded-full">TUNGGAK</span>
                                    <!-- TOMBOL BAYAR QRIS -->
                                    <button @click="showQris = true; nominal = '{{ number_format($t->nominal_tagihan, 0, ',', '.') }}'" 
                                            class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded hover:bg-blue-700 shadow flex items-center gap-1 transition">
                                        <i class="fas fa-qrcode"></i> Bayar QRIS
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-5 py-5 border-b text-center text-gray-500">Tidak ada riwayat tagihan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL SIMULASI QRIS -->
    <div x-show="showQris" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showQris" class="fixed inset-0 transition-opacity" @click="showQris = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">Scan QRIS untuk Bayar</h3>
                    <p class="text-sm text-gray-500 mb-4">Total: <span class="font-bold text-xl text-blue-600">Rp <span x-text="nominal"></span></span></p>
                    
                    <div class="bg-gray-100 p-4 rounded-lg border-2 border-dashed border-gray-300 inline-block mb-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS Code" class="w-48 h-48 mx-auto">
                    </div>
                    
                    <p class="text-xs text-gray-400">Silakan scan menggunakan aplikasi E-Wallet Anda.</p>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showQris = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Selesai / Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SIMULASI KWITANSI -->
    <div x-show="showReceipt" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showReceipt" class="fixed inset-0 transition-opacity" @click="showReceipt = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border-t-8 border-green-500">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="text-center border-b pb-4 mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">KWITANSI PEMBAYARAN</h2>
                        <p class="text-gray-500 text-sm">Kos Cumlaude Official</p>
                        <p class="text-xs text-gray-400">Jl. Raya Dramaga, Bogor</p>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diterima Dari:</span>
                            <span class="font-bold text-gray-800">{{ Auth::guard('penghuni')->user()->nama_penghuni }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Untuk Pembayaran:</span>
                            <span class="font-bold text-gray-800">Sewa Periode <span x-text="receiptData.periode"></span></span>
                        </div>
                        <div class="flex justify-between items-center bg-gray-100 p-2 rounded">
                            <span class="text-gray-600">Jumlah:</span>
                            <span class="font-bold text-xl text-green-600">Rp <span x-text="receiptData.nominal"></span></span>
                        </div>
                        <div class="text-center mt-6">
                            <span class="border-2 border-green-500 text-green-500 font-bold px-4 py-1 rounded uppercase tracking-widest transform -rotate-12 inline-block">LUNAS</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="showReceipt = false" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                    <button type="button" onclick="window.print()" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        <i class="fas fa-print mr-2"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>