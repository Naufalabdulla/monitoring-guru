<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
   
    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'guru_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    /**
     * Relasi ke Kelas
     * Satu jadwal milik satu kelas
     */
    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class);
    // }

    // /**
    //  * Relasi ke Mapel
    //  * Satu jadwal milik satu mapel
    //  */
    // public function mapel()
    // {
    //     return $this->belongsTo(Mapel::class);
    // }

    
    // public function guru()
    // {
    //     return $this->belongsTo(Guru::class);
    // }
}
