<?php

namespace App\Http\Controllers;

use App\Models\Staf;
use Illuminate\Http\Request;

class StafController extends Controller
{
    public function index(Request $request)
    {
        $query = Staf::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_staf', 'ilike', '%' . $request->search . '%')
                  ->orWhere('no_telepon_staf', 'ilike', '%' . $request->search . '%');
        }

        if ($request->has('role') && $request->role != '') {
            $query->where('peran', $request->role);
        }

        $staf = $query->orderBy('id_staf', 'asc')->get();
        return view('staf.index', compact('staf'));
    }

    public function create()
    {
        return view('staf.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_staf' => 'required',
            'peran' => 'required',
            'no_telepon_staf' => 'required|numeric|unique:staf,no_telepon_staf',
        ]);

        Staf::create($request->all());

        return redirect()->route('staf.index')->with('success', 'Staf berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $staf = Staf::findOrFail($id);
        return view('staf.edit', compact('staf'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_staf' => 'required',
            'peran' => 'required',
            'no_telepon_staf' => 'required|numeric',
        ]);

        $staf = Staf::findOrFail($id);
        $staf->update($request->all());

        return redirect()->route('staf.index')->with('success', 'Data staf berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Staf::findOrFail($id)->delete();
        return redirect()->route('staf.index')->with('success', 'Staf berhasil dihapus.');
    }
}