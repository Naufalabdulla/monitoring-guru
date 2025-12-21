<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
<<<<<<< HEAD
    protected $fillable = ['nama', 'tingkat_kelas', 'user_id'];
=======
    protected $fillable = ['nama', 'kelas_id', 'user_id'];
>>>>>>> origin/main

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
<<<<<<< HEAD
=======

    public function kelas()
{
    return $this->belongsTo(Kelas::class);
}
>>>>>>> origin/main
}
