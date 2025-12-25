<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Materi extends Model
{
    // Deskripsi mewakili atribut 'konten' di diagram
    protected $fillable = ['nama', 'mapel_id', 'deskripsi', 'file_pendukung'];

    // Atribut Private (-)
    private $idMateri;
    private $judul;
    private $konten;

    public function mapel(): BelongsTo {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    /**
     * METHOD UML (+ Public)
     */

    // + createMateri(m: Materi): void
    public function createMateri(Materi $m): void {
        $m->save();
    }

    // + getMateriById(id: String): Materi
    public static function getMateriById(string $id): Materi {
        return self::findOrFail($id);
    }

    // + updateMateri(m: Materi): void
    public function updateMateri(Materi $m): void {
        $m->save();
    }

    // + deleteMateri(id: String): void
    public static function deleteMateri(string $id): void {
        self::destroy($id);
    }
}