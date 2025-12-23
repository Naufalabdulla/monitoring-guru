<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    // Pastikan 'deskripsi' masuk di sini, bukan 'konten' jika DB pakai 'deskripsi'
    protected $fillable = ['nama', 'mapel_id', 'deskripsi', 'file_pendukung'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // Tetap sediakan metode sesuai diagram untuk kebutuhan PBO
    public static function getMateriById($id) {
        return self::findOrFail($id);
    }
}