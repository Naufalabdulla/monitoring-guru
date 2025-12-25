<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Kelas extends Model {
    protected $fillable = ['nama', 'tingkat'];
    public function mapels(): HasMany
    {
        return $this->hasMany(Mapel::class, 'kelas_id');
}

    // + getNama(): String
    public function getNama() { return $this->nama; }

    // + infoKelas(): ArrayList<Kelas>
    public static function infoKelas() { return self::all(); }

    // + createKelas(k: Kelas): void
    public function createKelas(Kelas $k) { $k->save(); }

    // + updateKelas(k: Kelas): void
    public function updateKelas(Kelas $k) { $k->save(); }

    // + deleteKelas(id: String): void
    public static function deleteKelas($id) { self::destroy($id); }
    
}