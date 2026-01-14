<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Poli;
use App\Models\Dokter;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::create([
            'name' => 'Admin Demo',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Demo',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Polis
        $poliUmum = Poli::create(['name' => 'Poli Umum']);
        $poliGigi = Poli::create(['name' => 'Poli Gigi']);
        $poliAnak = Poli::create(['name' => 'Poli Anak']);

        // Dokter
        Dokter::create(['name'=>'Dr. Faiz','poli_id'=>$poliUmum->id,'schedule_day'=>'Senin','start_time'=>'08:00','end_time'=>'12:00']);
        Dokter::create(['name'=>'Dr. Budi','poli_id'=>$poliGigi->id,'schedule_day'=>'Selasa','start_time'=>'09:00','end_time'=>'13:00']);
        Dokter::create(['name'=>'Dr. Reva','poli_id'=>$poliAnak->id,'schedule_day'=>'Rabu','start_time'=>'10:00','end_time'=>'14:00']);
        Dokter::create(['name'=>'Dr. Dedi','poli_id'=>$poliUmum->id,'schedule_day'=>'Kamis','start_time'=>'08:00','end_time'=>'12:00']);
        Dokter::create(['name'=>'Dr. Evi','poli_id'=>$poliGigi->id,'schedule_day'=>'Jumat','start_time'=>'09:00','end_time'=>'13:00']);
        Dokter::create(['name'=>'Dr. Fikri','poli_id'=>$poliAnak->id,'schedule_day'=>'Sabtu','start_time'=>'10:00','end_time'=>'14:00']);
    }
}