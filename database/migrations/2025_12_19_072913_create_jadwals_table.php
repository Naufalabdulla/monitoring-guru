<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();


            // optional: biar ga dobel jadwal di slot sama
            $table->unique(['kelas_id', 'guru_id', 'hari', 'jam_mulai'], 'jadwal_unique_slot');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
