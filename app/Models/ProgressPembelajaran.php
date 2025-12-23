<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressPembelajaran extends Model
{
    // Tambahkan baris ini agar Laravel tidak mencari tabel 'progress_pembelajarans'
    protected $table = 'progress_pembelajaran';

    protected $fillable = [
        'mapel_id', 
        'pertemuan', 
        'materi', 
        'status', 
        'catatan'
    ];

    // Relasi balik ke Mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}