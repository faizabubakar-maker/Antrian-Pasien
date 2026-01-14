<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QueueController extends Controller
{
    /**
     * =========================
     * DASHBOARD ANTRIAN ADMIN
     * =========================
     * Menampilkan seluruh antrian (atau filter hari ini)
     */
    public function index(Request $request)
    {
        // opsi filter tanggal via query ?tanggal=YYYY-MM-DD
        $tanggal = $request->query('tanggal', Carbon::today()->toDateString());

        $antrians = Antrian::with(['user','dokter.poli'])
            ->whereDate('tanggal_kunjungan', $tanggal)
            ->orderBy('tanggal_kunjungan','asc')
            ->orderBy('dokter_id')
            ->orderBy('nomor_antrian')
            ->get();

        $dokters = Dokter::with('poli')->get();

        return view('admin.queue.index', compact('antrians','dokters','tanggal'));
    }

    /**
     * =========================
     * UPDATE STATUS MANUAL
     * =========================
     */
    public function updateStatus(Request $request, Antrian $antrian)
    {
        $request->validate([
            'status' => 'required|in:WAITING,CALLED,DONE,CANCELED'
        ]);

        $antrian->update(['status' => $request->status]);

        return back()->with('success','Status antrian diperbarui');
    }

    /**
     * =========================
     * PANGGIL ANTRIAN BERIKUTNYA
     * =========================
     */
    public function callNext(Dokter $dokter)
    {
        $today = Carbon::today();

        // selesaikan antrian yang sedang dipanggil
        Antrian::where('dokter_id', $dokter->id)
            ->whereDate('tanggal_kunjungan', $today)
            ->where('status','CALLED')
            ->update(['status'=>'DONE']);

        // ambil antrian berikutnya yang WAITING
        $next = Antrian::where('dokter_id',$dokter->id)
            ->whereDate('tanggal_kunjungan',$today)
            ->where('status','WAITING')
            ->orderBy('nomor_antrian')
            ->first();

        if (!$next) {
            return back()->with('error','Tidak ada antrian berikutnya');
        }

        $next->update(['status'=>'CALLED']);

        return back()->with('success','Memanggil antrian nomor '.$next->nomor_antrian.' ('.$dokter->name.')');
    }
}