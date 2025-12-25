<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\Collection;

class Mapel extends Model
{
    protected $fillable = ['nama', 'kelas_id', 'user_id'];

    // Atribut Private sesuai Diagram (-)
    private $idMapel;
    private $namaMapel;
    private $deskripsi;
    private $materi; // Relasi Komposisi

    /**
     * BOOT: Menjalankan Sifat Komposisi
     * Jika Mapel dihapus, maka Materi di dalamnya WAJIB ikut terhapus
     */
    protected static function boot() {
        parent::boot();
        static::deleting(function ($mapel) {
            $mapel->materis()->delete(); 
        });
    }

    // Relasi Komposisi ke Materi
    public function materis(): HasMany {
        return $this->hasMany(Materi::class, 'mapel_id');
    }
    public function progress(): HasMany
    {
        return $this->hasMany(ProgressPembelajaran::class, 'mapel_id');
    }
    public function kelas(): BelongsTo { return $this->belongsTo(Kelas::class, 'kelas_id'); }
    public function guru(): BelongsTo { return $this->belongsTo(Guru::class, 'user_id'); }

    /**
     * METHOD UML (+ Public)
     */

    // + cariMateri(keyword: String): ArrayList<Materi>
    public function cariMateri(string $keyword): Collection {
        return $this->materis()->where('nama', 'like', "%$keyword%")->get();
    }

    // + getMapelById(id: String): Mapel
    public static function getMapelById(string $id): Mapel {
        return self::findOrFail($id);
    }

    // + updateMapel(m: Mapel): void
    public function updateMapel(Mapel $m): void {
        $m->save();
    }

    // + deleteMapel(id: String): void
    public static function deleteMapel(string $id): void {
        self::destroy($id);
    }
}