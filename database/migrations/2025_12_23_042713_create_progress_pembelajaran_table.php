<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress_pembelajaran', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel mapel
        $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');
        
        $table->string('pertemuan'); // Isi: Minggu 1, Minggu 2, ..., UTS, UAS, Ujian Akhir
        $table->text('materi')->nullable(); // Boleh kosong sesuai permintaan Anda
        $table->boolean('status')->default(0); // 0: Belum, 1: Selesai
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_pembelajaran');
    }
};
