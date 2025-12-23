<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model {
    protected $fillable = ['nama', 'tingkat'];

    public function getNama() { return $this->nama; }
    public function infoKelas() { return "Kelas: $this->nama"; }
}
