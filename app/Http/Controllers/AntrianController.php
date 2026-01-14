<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreAntrianRequest;

class AntrianController extends Controller
{
    use AuthorizesRequests;
    /**
     * =========================
     * DASHBOARD USER
     * =========================
     */
    public function userDashboard()
    {
        $antrians = Antrian::with(['dokter.poli'])
            ->where('user_id', Auth::id())
            ->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('nomor_antrian')
            ->paginate(10);

        return view('user.dashboard', compact('antrians'));
    }

    /**
     * =========================
     * FORM DAFTAR ANTRIAN
     * =========================
     */
    public function create()
    {
        $dokters = Dokter::with('poli')->get();
        return view('antrian.create', compact('dokters'));
    }

    /**
     * =========================
     * SIMPAN ANTRIAN
     * =========================
     */
    public function store(StoreAntrianRequest $request)
    {
        $dokterId = $request->dokter_id;
        $tanggal  = $request->tanggal_kunjungan;

        // max 20 antrian / dokter / hari
        $jumlahHariIni = Antrian::where('dokter_id', $dokterId)
            ->where('tanggal_kunjungan', $tanggal)
            ->count();

        if ($jumlahHariIni >= 20) {
            return back()->withErrors([
                'dokter_id' => 'Kuota dokter untuk tanggal ini sudah penuh'
            ]);
        }

        // tidak boleh daftar dua kali
        $sudahDaftar = Antrian::where('dokter_id', $dokterId)
            ->where('tanggal_kunjungan', $tanggal)
            ->where('user_id', Auth::id())
            ->exists();

        if ($sudahDaftar) {
            return back()->withErrors([
                'dokter_id' => 'Anda sudah terdaftar pada dokter & tanggal ini'
            ]);
        }

        Antrian::create([
            'user_id'           => Auth::id(),
            'dokter_id'         => $dokterId,
            'tanggal_kunjungan' => $tanggal,
            'keluhan'           => $request->keluhan,
            'nomor_antrian'     => $jumlahHariIni + 1,
            'status'            => 'WAITING',
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Antrian berhasil dibuat');
    }

    /**
     * =========================
     * RIWAYAT ANTRIAN
     * =========================
     */
    public function index()
    {
        $antrians = Antrian::with(['dokter.poli'])
            ->where('user_id', Auth::id())
            ->orderBy('tanggal_kunjungan', 'desc')
            ->paginate(10);

        return view('antrian.index', compact('antrians'));
    }

    /**
     * =========================
     * CANCEL ANTRIAN (PAKAI POLICY)
     * =========================
     */
    public function cancel(Antrian $antrian)
    {
        // 🔐 pakai AntrianPolicy
        $this->authorize('cancel', $antrian);

        $antrian->update([
            'status' => 'CANCELED'
        ]);

        return back()->with('success', 'Antrian berhasil dibatalkan');
    }
}