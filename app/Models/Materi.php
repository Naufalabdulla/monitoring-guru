<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
<<<<<<< HEAD
    protected $fillable = ['nama', 'mapel_id'];
=======
    protected $fillable = ['nama', 'mapel_id', 'deskripsi', 'file_pendukung'];
>>>>>>> origin/main

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
