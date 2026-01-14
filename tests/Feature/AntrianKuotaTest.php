<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Antrian;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AntrianKuotaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_tidak_bisa_daftar_jika_kuota_antrian_penuh()
    {
        // =========================
        // SETUP DATA
        // =========================

        // Buat user
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        // Buat poli
        $poli = Poli::create([
            'name' => 'Poli Umum'
        ]);

        // Buat dokter
        $dokter = Dokter::create([
            'name'         => 'Dr. Test',
            'poli_id'      => $poli->id,
            'schedule_day' => 'Senin',
            'start_time'   => '08:00',
            'end_time'     => '12:00',
        ]);

        // Isi antrian sampai penuh (20)
        for ($i = 1; $i <= 20; $i++) {
            Antrian::create([
                'user_id'           => User::factory()->create()->id,
                'dokter_id'         => $dokter->id,
                'tanggal_kunjungan' => now()->toDateString(),
                'keluhan'           => 'Keluhan ke-'.$i.' yang cukup panjang',
                'nomor_antrian'     => $i,
                'status'            => 'WAITING',
            ]);
        }

        // =========================
        // AKSI YANG DITEST
        // =========================

        $response = $this->actingAs($user)->post('/antrian', [
            'dokter_id'         => $dokter->id,
            'tanggal_kunjungan' => now()->toDateString(),
            'keluhan'           => 'Saya ingin daftar tapi kuota penuh',
        ]);

        // =========================
        // ASSERTION
        // =========================

        $response->assertSessionHasErrors('dokter_id');

        $this->assertDatabaseCount('antrians', 20);
    }
}