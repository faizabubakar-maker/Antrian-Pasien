<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('dokter_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('date');

            $table->unsignedInteger('queue_number');

            $table->string('complaint');

            $table->enum('status', [
                'WAITING',
                'CALLED',
                'DONE',
                'CANCELED'
            ])->default('WAITING');

            $table->timestamps();

            // 1 user tidak boleh daftar 2x ke dokter yang sama di tanggal yang sama
            $table->unique(['user_id','dokter_id','date']);

            // nomor antrian unik per dokter per tanggal
            $table->unique(['dokter_id','date','queue_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};