<?php

namespace App\Http\Controllers;

use App\Models\LaporanKerusakan;
use App\Models\Penghuni;
use App\Models\Kamar;
use App\Models\Staf;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Gunakan Transaction

class LaporanKerusakanController extends Controller
{
    // ... Index dan Create tetap sama ... 
    public function index(Request $request)
    {
        $query = LaporanKerusakan::with(['penghuni', 'kamar', 'staf']);
        if ($request->has('status') && $request->status != '') {
            $query->where('status_laporan', $request->status);
        }
        $laporan = $query->orderBy('tanggal_lapor', 'desc')->get();
        return view('laporan_kerusakan.index', compact('laporan'));
    }

    public function create()
    {
        if (Auth::guard('penghuni')->check()) {
            $penghuni = Auth::guard('penghuni')->user();
            $no_kamar = $penghuni->no_kamar;
            $fasilitas = Fasilitas::where('no_kamar', $no_kamar)->get();
            return view('laporan_kerusakan.create', compact('penghuni', 'no_kamar', 'fasilitas'));
        } 
        return redirect()->route('laporan.index')->with('error', 'Staf tidak dapat membuat laporan.');
    }

    // UPDATE STORE: OTOMATIS UBAH JADI RUSAK
    public function store(Request $request)
    {
        $request->validate([
            'id_penghuni' => 'required',
            'no_kamar' => 'required',
            'status_laporan' => 'required'
        ]);

        DB::transaction(function () use ($request) {
            $data = $request->all();
            $data['tanggal_lapor'] = now();

            if ($request->filled('id_fasilitas') && $request->id_fasilitas != 'lainnya') {
                $fasilitas = Fasilitas::find($request->id_fasilitas);
                
                // UPDATE KONDISI FASILITAS JADI RUSAK
                if($fasilitas) {
                    $fasilitas->update(['kondisi' => 'Rusak']);
                    $namaFasilitas = $fasilitas->nama_fasilitas;
                    $data['deskripsi'] = "[Rusak: $namaFasilitas] " . $request->deskripsi_tambahan;
                    $data['id_fasilitas'] = $request->id_fasilitas;
                }
            } else {
                $data['deskripsi'] = "[Lainnya] " . $request->deskripsi_tambahan;
                $data['id_fasilitas'] = null;
            }
            
            LaporanKerusakan::create($data);
        });

        if (Auth::guard('penghuni')->check()) {
            return redirect()->route('dashboard.penghuni')->with('success', 'Laporan dikirim & status fasilitas diperbarui.');
        }
        return redirect()->route('laporan.index');
    }

    public function edit($id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);
        $staf = Staf::where('peran', 'Teknisi')->get(); 
        return view('laporan_kerusakan.edit', compact('laporan', 'staf'));
    }

    // UPDATE PROGRESS: JIKA SELESAI, FASILITAS JADI BAIK
    public function update(Request $request, $id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);
        
        DB::transaction(function () use ($request, $laporan) {
            $laporan->update($request->all());

            // Jika status berubah jadi SELESAI, dan ada fasilitas terkait, ubah jadi BAIK
            if ($request->status_laporan == 'Selesai' && $laporan->id_fasilitas) {
                $fasilitas = Fasilitas::find($laporan->id_fasilitas);
                if($fasilitas) {
                    $fasilitas->update(['kondisi' => 'Baik']);
                }
            }
        });

        return redirect()->route('laporan.index')->with('success', 'Laporan diperbarui & kondisi fasilitas disinkronkan.');
    }

    public function destroy($id)
    {
        LaporanKerusakan::findOrFail($id)->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan dihapus');
    }
}