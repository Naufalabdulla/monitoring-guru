<?php

namespace App\Logic\Akademik;

class Materi
{
    protected string $idMateri;
    protected string $judul;
    protected string $konten;
    protected Mapel $mapel;

    public function __construct(
        string $idMateri,
        string $judul,
        string $konten,
        Mapel $mapel
    ) {
        $this->idMateri = $idMateri;
        $this->judul    = $judul;
        $this->konten   = $konten;
        $this->mapel    = $mapel;
    }

    // ======================
    // Getter (Encapsulation)
    // ======================
    public function getIdMateri(): string
    {
        return $this->idMateri;
    }

    public function getJudul(): string
    {
        return $this->judul;
    }

    public function getKonten(): string
    {
        return $this->konten;
    }

    public function getMapel(): Mapel
    {
        return $this->mapel;
    }

    // ======================
    // Simulasi operasi CRUD
    // ======================
    public function updateMateri(Materi $materi): void
    {
        $this->judul  = $materi->judul;
        $this->konten = $materi->konten;
    }
}
