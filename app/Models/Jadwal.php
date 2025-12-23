<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;

class Jadwal extends Model
{
    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'guru_id', // Pastikan ini ada
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // PERBAIKAN DI SINI:
    // Sesuaikan foreign key dengan kolom di database (guru_id)
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
}