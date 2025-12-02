<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $query = Tagihan::with('penghuni');

        if ($request->has('status') && $request->status != '') {
            $query->where('status_bayar', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('penghuni', function($q) use ($request) {
                $q->where('nama_penghuni', 'ilike', '%' . $request->search . '%');
            });
        }

        $tagihan = $query->orderBy('periode', 'desc')->get();
        return view('tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $penghuni = Penghuni::where('status_keaktifan', 'Aktif')->get();
        return view('tagihan.create', compact('penghuni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penghuni' => 'required',
            'periode' => 'required',
            'nominal_tagihan' => 'required|numeric',
            'status_bayar' => 'required'
        ]);

        Tagihan::create($request->all());
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dicatat');
    }

    public function edit($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $penghuni = Penghuni::all();
        return view('tagihan.edit', compact('tagihan', 'penghuni'));
    }

    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update($request->all());
        return redirect()->route('tagihan.index')->with('success', 'Status tagihan diperbarui');
    }

    public function destroy($id)
    {
        Tagihan::findOrFail($id)->delete();
        return redirect()->route('tagihan.index')->with('success', 'Data tagihan dihapus');
    }
}