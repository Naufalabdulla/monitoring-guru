<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $fillable = ['nama', 'tingkat_kelas', 'user_id'];

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}
