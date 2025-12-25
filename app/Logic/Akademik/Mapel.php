<?php

namespace App\Logic\Akademik;

use Illuminate\Support\Collection;

class Mapel
{
    private string $idMapel;
    private string $namaMapel;
    private string $deskripsi;
    private Collection $daftarMateri; // Komposisi ArrayList<Materi>

    public function __construct(string $id, string $nama, string $desc) {
        $this->idMapel = $id;
        $this->namaMapel = $nama;
        $this->deskripsi = $desc;
        $this->daftarMateri = collect();
    }

    // + cariMateri(keyword: String): ArrayList<Materi>
    public function cariMateri(string $keyword): array {
        return $this->daftarMateri->filter(function($m) use ($keyword) {
            return stripos($m->getJudul(), $keyword) !== false;
        })->all();
    }
}