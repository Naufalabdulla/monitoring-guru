<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Bersihkan data string (Minggu 1 -> 1) agar tidak error saat diconvert ke Integer
        DB::statement("UPDATE progress_pembelajaran SET pertemuan = '99' WHERE pertemuan = 'UAS' OR pertemuan = 'Ujian Akhir'");
        DB::statement("UPDATE progress_pembelajaran SET pertemuan = '50' WHERE pertemuan = 'UTS'");
        DB::statement("UPDATE progress_pembelajaran SET pertemuan = REGEXP_REPLACE(pertemuan, '[^0-9]', '')");

        // 2. Ubah tipe data kolom menjadi Integer
        Schema::table('progress_pembelajaran', function (Blueprint $table) {
            $table->integer('pertemuan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('progress_pembelajaran', function (Blueprint $table) {
            $table->string('pertemuan')->change();
        });
    }
};