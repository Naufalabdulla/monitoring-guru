<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressPembelajaran extends Model {
    protected $table = 'progress_pembelajaran';
    protected $fillable = ['mapel_id', 'pertemuan', 'materi_id', 'status', 'catatan'];

    // Atribut Private untuk PBO (-)
    private $pertemuan;
    private $status;

    // Relasi ke Materi agar otomatis muncul saat diupdate
    public function materi(): BelongsTo {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function mapel(): BelongsTo {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // + lihatDetail(id: String): Progress
    public static function lihatDetail($id) { 
        return self::with('materi')->findOrFail($id); 
    }
}