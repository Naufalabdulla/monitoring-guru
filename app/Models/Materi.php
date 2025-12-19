<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['nama', 'mapel_id'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
