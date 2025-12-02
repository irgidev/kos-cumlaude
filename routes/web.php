<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\LaporanKerusakanController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth:web'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('penghuni', PenghuniController::class);
    Route::resource('kamar', KamarController::class);
    Route::resource('fasilitas', FasilitasController::class);
    
    Route::resource('tagihan', TagihanController::class);
    
    Route::get('/laporan', [LaporanKerusakanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}/edit', [LaporanKerusakanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{laporan}', [LaporanKerusakanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{laporan}', [LaporanKerusakanController::class, 'destroy'])->name('laporan.destroy');

    Route::get('/rekap-laporan', [RekapController::class, 'index'])->name('rekap.index');
});

Route::middleware(['auth:web'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('penghuni', PenghuniController::class);
    Route::resource('kamar', KamarController::class);
    Route::resource('fasilitas', FasilitasController::class);
    
    Route::resource('staf', App\Http\Controllers\StafController::class); 
    
});

Route::middleware(['auth:penghuni'])->group(function () {
    
    Route::get('/portal-penghuni', function() {
        $penghuni = Auth::guard('penghuni')->user();
        
        $riwayatLaporan = App\Models\LaporanKerusakan::with(['kamar', 'staf'])
                            ->where('id_penghuni', $penghuni->id_penghuni)
                            ->orderBy('tanggal_lapor', 'desc')
                            ->get();

        return view('penghuni_portal.dashboard', compact('riwayatLaporan'));
    })->name('dashboard.penghuni');

    Route::get('/saya/laporan/buat', [LaporanKerusakanController::class, 'create'])->name('penghuni.laporan.create');
    Route::post('/saya/laporan', [LaporanKerusakanController::class, 'store'])->name('penghuni.laporan.store');
    
    Route::get('/saya/tagihan', function() {
        $tagihan = App\Models\Tagihan::where('id_penghuni', Auth::guard('penghuni')->id())
                    ->orderBy('periode', 'desc')->get();
        return view('penghuni_portal.tagihan', compact('tagihan'));
    })->name('penghuni.tagihan');

});