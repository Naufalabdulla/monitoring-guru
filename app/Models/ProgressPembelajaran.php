<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressPembelajaran extends Model {
    protected $table = 'progress_pembelajaran';
    protected $fillable = ['mapel_id', 'pertemuan', 'materi', 'status', 'catatan'];

    public function lihatDetail($id) { return self::findOrFail($id); }
}