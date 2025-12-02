<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    const HARGA_STANDARD = 750000;
    const HARGA_VIP = 850000;
    const HARGA_VVIP = 1000000;

    public function index(Request $request)
    {
        $query = Kamar::with('penghuni');

        if ($request->has('status') && $request->status != '') {
            $query->where('status_ketersediaan', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('no_kamar', 'ilike', '%' . $request->search . '%');
        }

        $kamar = $query->orderBy('no_kamar', 'asc')->get();

        return view('kamar.index', compact('kamar'));
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kamar' => 'required|unique:kamar,no_kamar',
            'tipe' => 'required',
            'status_ketersediaan' => 'required'
        ]);

        $harga = 0;
        switch($request->tipe) {
            case 'Standard': $harga = self::HARGA_STANDARD; break;
            case 'VIP': $harga = self::HARGA_VIP; break;
            case 'VVIP': $harga = self::HARGA_VVIP; break;
        }

        Kamar::create([
            'no_kamar' => $request->no_kamar,
            'tipe' => $request->tipe,
            'harga_sewa' => $harga,
            'status_ketersediaan' => $request->status_ketersediaan
        ]);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);
        
        $harga = $kamar->harga_sewa;
        if($request->has('tipe')) {
            switch($request->tipe) {
                case 'Standard': $harga = self::HARGA_STANDARD; break;
                case 'VIP': $harga = self::HARGA_VIP; break;
                case 'VVIP': $harga = self::HARGA_VVIP; break;
            }
        }

        $kamar->update([
            'tipe' => $request->tipe,
            'harga_sewa' => $harga,
            'status_ketersediaan' => $request->status_ketersediaan
        ]);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kamar::findOrFail($id)->delete();
        return redirect()->route('kamar.index')->with('success', 'Data kamar dihapus');
    }
}