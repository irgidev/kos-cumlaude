<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\Mahasiswa;
use App\Models\Pekerja;
use App\Models\Kamar;
use App\Models\Tagihan;
use App\Models\LaporanKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenghuniController extends Controller
{
    public function index(Request $request)
    {
        $query = Penghuni::with(['mahasiswa', 'pekerja', 'kamar']);

        if ($request->has('jenis') && $request->jenis != '') {
            if ($request->jenis == 'Mahasiswa') {
                $query->whereHas('mahasiswa');
            } elseif ($request->jenis == 'Pekerja') {
                $query->whereHas('pekerja');
            }
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status_keaktifan', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_penghuni', 'ilike', '%' . $request->search . '%');
        }

        $penghuni = $query->orderBy('id_penghuni', 'desc')->get();
        return view('penghuni.index', compact('penghuni'));
    }

    public function create()
    {
        $kamarKosong = Kamar::where('status_ketersediaan', 'Kosong')->get();
        return view('penghuni.create', compact('kamarKosong'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penghuni' => 'required',
            'no_telepon_penghuni' => 'required|unique:penghuni',
            'no_kamar' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $penghuni = Penghuni::create([
                'nama_penghuni' => $request->nama_penghuni,
                'no_telepon_penghuni' => $request->no_telepon_penghuni,
                'tanggal_masuk' => $request->tanggal_masuk,
                'status_keaktifan' => $request->status_keaktifan,
                'no_kamar' => $request->no_kamar
            ]);

            if ($request->jenis_penghuni == 'Mahasiswa') {
                Mahasiswa::create([
                    'id_penghuni' => $penghuni->id_penghuni,
                    'nim' => $request->nim,
                    'nama_universitas' => $request->nama_universitas
                ]);
            } else if ($request->jenis_penghuni == 'Pekerja') {
                Pekerja::create([
                    'id_penghuni' => $penghuni->id_penghuni,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'jabatan' => $request->jabatan
                ]);
            }

            Kamar::where('no_kamar', $request->no_kamar)->update(['status_ketersediaan' => 'Terisi']);
        });

        return redirect()->route('penghuni.index')->with('success', 'Penghuni berhasil didaftarkan');
    }

    public function edit($id)
    {
        $penghuni = Penghuni::with(['mahasiswa', 'pekerja'])->findOrFail($id);
        $kamarKosong = Kamar::where('status_ketersediaan', 'Kosong')->get();
        return view('penghuni.edit', compact('penghuni', 'kamarKosong'));
    }

// GANTI FUNGSI update() DI PENGHUNICONTROLLER DENGAN INI
    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $kamarLama = $penghuni->no_kamar;
        $kamarBaru = $request->no_kamar;

        DB::transaction(function () use ($penghuni, $request, $kamarLama, $kamarBaru) {
            // Update data dasar
            $penghuni->update([
                'nama_penghuni' => $request->nama_penghuni,
                'no_telepon_penghuni' => $request->no_telepon_penghuni,
                'status_keaktifan' => $request->status_keaktifan,
                'no_kamar' => $kamarBaru
            ]);

            // Cek jika pindah kamar
            if ($kamarLama != $kamarBaru) {
                // Kamar lama jadi Kosong
                if ($kamarLama) {
                    Kamar::where('no_kamar', $kamarLama)->update(['status_ketersediaan' => 'Kosong']);
                }
                // Kamar baru jadi Terisi
                if ($kamarBaru) {
                    Kamar::where('no_kamar', $kamarBaru)->update(['status_ketersediaan' => 'Terisi']);
                }
            }
            
            // Jika status penghuni jadi Non-Aktif, kamar otomatis Kosong
            if ($request->status_keaktifan == 'Non-Aktif') {
                 Kamar::where('no_kamar', $kamarBaru)->update(['status_ketersediaan' => 'Kosong']);
                 // Opsional: set no_kamar di tabel penghuni jadi NULL jika keluar kos
            }
        });

        return redirect()->route('penghuni.index')->with('success', 'Data penghuni berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $noKamar = $penghuni->no_kamar;

        Tagihan::where('id_penghuni', $id)->delete();
        LaporanKerusakan::where('id_penghuni', $id)->delete();
        
        $penghuni->delete();

        if($noKamar) {
            Kamar::where('no_kamar', $noKamar)->update(['status_ketersediaan' => 'Kosong']);
        }

        return redirect()->route('penghuni.index')->with('success', 'Data penghuni dihapus, tagihan & laporan terkait dibersihkan, kamar kembali kosong.');
    }
}