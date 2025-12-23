<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\ProgressPembelajaran;



class Mapel extends Model
{
    protected $fillable = ['nama', 'kelas_id', 'user_id'];

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function progress()
    {
        return $this->hasMany(ProgressPembelajaran::class, 'mapel_id');
    }

    public function getPersentaseAttribute()
    {
        $totalIndikator = 19; // 16 minggu + 3 ujian
        $selesai = $this->progressPembelajaran()->where('status', 1)->count();
        return ($selesai / $totalIndikator) * 100;
    }
}
