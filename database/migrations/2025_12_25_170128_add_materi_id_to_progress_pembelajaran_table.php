<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progress_pembelajaran', function (Blueprint $table) {
            // Menambahkan kolom materi_id setelah kolom pertemuan
            $table->unsignedBigInteger('materi_id')->nullable()->after('pertemuan');

            // Menambahkan relasi ke tabel materis
            $table->foreign('materi_id')->references('id')->on('materis')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('progress_pembelajaran', function (Blueprint $table) {
            $table->dropForeign(['materi_id']);
            $table->dropColumn('materi_id');
        });
    }
};