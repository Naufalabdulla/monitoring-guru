<?php

namespace App\Logic\Akademik;

use App\Logic\User\Guru;

class Jadwal
{
    /**
     * ATRIBUT PRIVATE (-)
     */
    private string $idJadwal;
    private Kelas $kelas;
    private Mapel $mapel;
    private Guru $guru;
    private string $hari;
    private string $jamMulai;
    private string $jamSelesai;

    public function __construct(string $id, Kelas $k, Mapel $m, Guru $g, string $h, string $start, string $end)
    {
        $this->idJadwal = $id;
        $this->kelas = $k;
        $this->mapel = $m;
        $this->guru = $g;
        $this->hari = $h;
        $this->jamMulai = $start;
        $this->jamSelesai = $end;
    }

    // Getter untuk akses data private
    public function getHari(): string { return $this->hari; }
    public function getJamMulai(): string { return $this->jamMulai; }

    /**
     * METHOD UML (+ Public)
     */
    public function createJadwal(Jadwal $j): void { /* Logic simulasi */ }
    public function updateJadwal(Jadwal $j): void { /* Logic simulasi */ }
}