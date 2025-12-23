<?php

namespace App\Logic\Akademik;

class Mapel
{
    protected string $idMapel;
    protected string $namaMapel;
    protected string $deskripsi;

    /** @var Materi[] */
    protected array $daftarMateri = [];

    public function __construct(
        string $idMapel,
        string $namaMapel,
        string $deskripsi
    ) {
        $this->idMapel   = $idMapel;
        $this->namaMapel = $namaMapel;
        $this->deskripsi = $deskripsi;
    }

    // ======================
    // Getter (Encapsulation)
    // ======================
    public function getIdMapel(): string
    {
        return $this->idMapel;
    }

    public function getNamaMapel(): string
    {
        return $this->namaMapel;
    }

    public function getDeskripsi(): string
    {
        return $this->deskripsi;
    }

    // ======================
    // Relasi Mapel -> Materi
    // ======================
    public function tambahMateri(Materi $materi): void
    {
        $this->daftarMateri[] = $materi;
    }

    /** @return Materi[] */
    public function cariMateri(string $keyword): array
    {
        $hasil = [];

        foreach ($this->daftarMateri as $materi) {
            if (stripos($materi->getJudul(), $keyword) !== false) {
                $hasil[] = $materi;
            }
        }

        return $hasil;
    }

    // ======================
    // Simulasi operasi CRUD
    // ======================
    public function updateMapel(Mapel $mapel): void
    {
        $this->namaMapel = $mapel->namaMapel;
        $this->deskripsi = $mapel->deskripsi;
    }
}
