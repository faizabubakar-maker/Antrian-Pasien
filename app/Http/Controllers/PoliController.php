<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::latest()->paginate(10);
        return view('admin.polis.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.polis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:polis,name',
        ]);

        Poli::create($request->only('name'));

        return redirect()->route('admin.polis.index')
            ->with('success','Poli berhasil ditambahkan');
    }

    public function edit(Poli $poli)
    {
        return view('admin.polis.edit', compact('poli'));
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'name' => 'required|min:3|unique:polis,name,'.$poli->id,
        ]);

        $poli->update($request->only('name'));

        return redirect()->route('admin.polis.index')
            ->with('success','Poli berhasil diperbarui');
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('admin.polis.index')
            ->with('success','Poli berhasil dihapus');
    }
}