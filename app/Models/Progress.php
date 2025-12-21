<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';

    protected $fillable = [
        'jadwal_id',
        'tanggal',
        'materi',
        'status',
        'catatan',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
