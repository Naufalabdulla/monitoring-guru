<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model {
    protected $fillable = ['kelas_id', 'mapel_id', 'guru_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function guru() { return $this->belongsTo(User::class, 'guru_id'); }
    public function mapel() { return $this->belongsTo(Mapel::class, 'mapel_id'); }
    public function kelas() { return $this->belongsTo(Kelas::class, 'kelas_id'); }
    public static function getJadwalHariIni($guru_id, $hari) {
        return self::where('guru_id', $guru_id)->where('hari', $hari)->get();
    }
}
