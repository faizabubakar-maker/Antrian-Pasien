<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('poli')->latest()->paginate(10);
        return view('admin.dokters.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokters.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'poli_id'=>'required|exists:polis,id',
            'schedule_day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
        ]);

        Dokter::create($request->only('name','poli_id','schedule_day','start_time','end_time'));

        return redirect()->route('admin.dokters.index')
            ->with('success','Dokter berhasil ditambahkan');
    }

    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokters.edit', compact('dokter','polis'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'name'=>'required|min:3',
            'poli_id'=>'required|exists:polis,id',
            'schedule_day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
        ]);

        $dokter->update($request->only('name','poli_id','schedule_day','start_time','end_time'));

        return redirect()->route('admin.dokters.index')
            ->with('success','Dokter berhasil diperbarui');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('admin.dokters.index')
            ->with('success','Dokter berhasil dihapus');
    }
}