<?php

namespace App\Logic\Akademik;

use App\Logic\User\Guru;

class Jadwal
{
    protected string $idJadwal;
    protected Kelas $kelas;
    protected Mapel $mapel;
    protected Guru $guru;
    protected string $hari;
    protected string $jamMulai;
    protected string $jamSelesai;

    public function __construct(
        string $idJadwal,
        Kelas $kelas,
        Mapel $mapel,
        Guru $guru,
        string $hari,
        string $jamMulai,
        string $jamSelesai
    ) {
        $this->idJadwal = $idJadwal;
        $this->kelas = $kelas;
        $this->mapel = $mapel;
        $this->guru = $guru;
        $this->hari = $hari;
        $this->jamMulai = $jamMulai;
        $this->jamSelesai = $jamSelesai;
    }

    // ===== Getter (Encapsulation) =====
    public function getIdJadwal(): string
    {
        return $this->idJadwal;
    }

    public function getKelas(): Kelas
    {
        return $this->kelas;
    }

    public function getMapel(): Mapel
    {
        return $this->mapel;
    }

    public function getGuru(): Guru
    {
        return $this->guru;
    }

    public function getHari(): string
    {
        return $this->hari;
    }

    public function getJamMulai(): string
    {
        return $this->jamMulai;
    }

    public function getJamSelesai(): string
    {
        return $this->jamSelesai;
    }

    // ===== Sesuai UML: getJadwalHariIni(g: Guru, hari: String): ArrayList<Jadwal> =====
    /**
     * @param Jadwal[] $semuaJadwal
     * @return Jadwal[]
     */
    public function getJadwalHariIni(Guru $g, string $hari, array $semuaJadwal): array
    {
        $hasil = [];

        foreach ($semuaJadwal as $jadwal) {
            if (
                $jadwal->getGuru()->getIdUser() === $g->getIdUser() &&
                strtolower($jadwal->getHari()) === strtolower($hari)
            ) {
                $hasil[] = $jadwal;
            }
        }

        return $hasil;
    }

    // ===== Sesuai UML: CRUD (logic-level) =====
    public function createJadwal(Jadwal $j): void
    {
        // contoh business rule sederhana: jamMulai harus < jamSelesai
        $this->validasiJam($j->jamMulai, $j->jamSelesai);
    }

    public function getJadwalById(string $id): Jadwal
    {
        if ($this->idJadwal !== $id) {
            throw new \RuntimeException("Jadwal dengan id $id tidak ditemukan pada object ini.");
        }
        return $this;
    }

    public function updateJadwal(Jadwal $j): void
    {
        $this->validasiJam($j->jamMulai, $j->jamSelesai);

        $this->kelas = $j->kelas;
        $this->mapel = $j->mapel;
        $this->guru = $j->guru;
        $this->hari = $j->hari;
        $this->jamMulai = $j->jamMulai;
        $this->jamSelesai = $j->jamSelesai;
    }

    public function deleteJadwal(string $id): void
    {
        if ($this->idJadwal !== $id) {
            throw new \RuntimeException("Id tidak cocok. Tidak bisa delete jadwal.");
        }
    }

    // ===== Helper / Business Rule =====
    private function validasiJam(string $mulai, string $selesai): void
    {
        if ($mulai >= $selesai) {
            throw new \InvalidArgumentException("Jam mulai harus lebih kecil dari jam selesai.");
        }
    }
}
