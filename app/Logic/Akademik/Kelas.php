<?php

namespace App\Logic\Akademik;

class Kelas
{
    private string $idKelas;
    private string $namaKelas;

    /** @var Kelas[] */
    private array $infoKelas = [];

    public function __construct(string $idKelas, string $namaKelas)
    {
        $this->idKelas = $idKelas;
        $this->namaKelas = $namaKelas;
    }

    // ======================
    // Encapsulation (Getter)
    // ======================
    public function getIdKelas(): string
    {
        return $this->idKelas;
    }

    public function getNama(): string
    {
        return $this->namaKelas;
    }

    // ======================
    // Sesuai UML: infoKelas(): ArrayList<Kelas>
    // ======================
    /** @return Kelas[] */
    public function infoKelas(): array
    {
        return $this->infoKelas;
    }

    // Biar bisa nambah data ke list infoKelas (OOP list)
    public function tambahInfoKelas(Kelas $kelas): void
    {
        $this->infoKelas[] = $kelas;
    }

    // ======================
    // Sesuai UML: CRUD method
    // (logic-level; DB action nanti via Model/Mapper)
    // ======================
    public function createKelas(Kelas $kelas): void
    {
        $this->tambahInfoKelas($kelas);
    }

    public function updateKelas(Kelas $kelas): void
    {
        // update object ini dengan data dari parameter
        $this->namaKelas = $kelas->namaKelas;
    }

    public function deleteKelas(string $id): void
    {
        // hapus dari list infoKelas (in-memory)
        $this->infoKelas = array_values(array_filter(
            $this->infoKelas,
            fn (Kelas $k) => $k->getIdKelas() !== $id
        ));
    }
}
