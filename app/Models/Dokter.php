<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'poli_id',
        'schedule_day',
        'start_time',
        'end_time',
    ];

    // Relasi: Dokter milik Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    // Relasi: Dokter punya banyak antrian
    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }
}