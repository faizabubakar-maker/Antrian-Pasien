<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('dokter_id')
                ->constrained()
                ->cascadeOnDelete();

            // ✅ WAJIB SESUAI CONTROLLER & TEST
            $table->date('tanggal_kunjungan');
            $table->text('keluhan');
            $table->integer('nomor_antrian');

            $table->enum('status', [
                'WAITING',
                'CALLED',
                'DONE',
                'CANCELED'
            ])->default('WAITING');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};