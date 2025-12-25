<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;

class Jadwal extends Model
{
    protected $fillable = ['kelas_id', 'mapel_id', 'guru_id', 'hari', 'jam_mulai', 'jam_selesai'];

    /**
     * ATRIBUT PRIVATE (Sesuai Diagram -)
     * Mendeklarasikan atribut secara eksplisit untuk keperluan PBO
     */
    private $idJadwal;
    private $kelas;
    private $mapel;
    private $guru;
    private $hari;
    private $jamMulai;
    private $jamSelesai;

    /**
     * RELASI
     */
    public function guru(): BelongsTo { return $this->belongsTo(Guru::class, 'guru_id'); }
    public function mapel(): BelongsTo { return $this->belongsTo(Mapel::class, 'mapel_id'); }
    public function kelas(): BelongsTo { return $this->belongsTo(Kelas::class, 'kelas_id'); }

    /**
     * METHOD UML (+ Public)
     */

    // + getJadwalHariIni(g: Guru, hari: String): ArrayList<Jadwal>
    public static function getJadwalHariIni(Guru $g, string $hari): Collection
    {
        return self::where('guru_id', $g->id)
                   ->where('hari', $hari)
                   ->with(['mapel', 'kelas'])
                   ->get();
    }

    // + createJadwal(j: Jadwal): void
    public function createJadwal(Jadwal $j): void { $j->save(); }

    // + getJadwalById(id: String): Jadwal
    public static function getJadwalById(string $id): Jadwal { return self::findOrFail($id); }

    // + updateJadwal(j: Jadwal): void
    public function updateJadwal(Jadwal $j): void { $j->save(); }

    // + deleteJadwal(id: String): void
    public static function deleteJadwal(string $id): void { self::destroy($id); }
}