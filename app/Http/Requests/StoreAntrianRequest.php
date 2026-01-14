<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntrianRequest extends FormRequest
{
    public function authorize()
    {
        // Hanya user yang login bisa daftar antrian
        return auth()->check();
    }

    public function rules()
    {
        return [
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'keluhan' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'dokter_id.required' => 'Pilih dokter terlebih dahulu',
            'dokter_id.exists' => 'Dokter tidak valid',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan harus diisi',
            'tanggal_kunjungan.date' => 'Format tanggal tidak valid',
            'tanggal_kunjungan.after_or_equal' => 'Tanggal kunjungan minimal hari ini',
            'keluhan.required' => 'Tuliskan keluhan Anda',
            'keluhan.max' => 'Keluhan maksimal 500 karakter',
        ];
    }
}