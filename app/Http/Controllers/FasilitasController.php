<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kamar;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::with('kamar')->orderBy('no_kamar')->get();
        return view('fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        $kamar = Kamar::all();
        return view('fasilitas.create', compact('kamar'));
    }

    public function store(Request $request)
    {
        Fasilitas::create($request->all());
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas ditambahkan');
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $kamar = Kamar::all();
        return view('fasilitas.edit', compact('fasilitas', 'kamar'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->update($request->all());
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas diperbarui');
    }

    public function destroy($id)
    {
        Fasilitas::findOrFail($id)->delete();
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas dihapus');
    }
}