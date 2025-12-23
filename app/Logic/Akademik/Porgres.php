<?php

namespace App\Logic\Akademik;

use DateTime;

class Progress
{
    protected string $idProgress;

    // Di diagram: siswa : Siswa (kalau belum ada class Siswa, kita simpan id saja dulu)
    protected ?string $siswaId;

    // Di diagram: jadwal : Jadwal (kalau class Jadwal belum dibuat, simpan id + opsional object)
    protected ?string $jadwalId;

    protected DateTime $tanggal;
    protected string $capaian;
    protected string $status;

    public function __construct(
        string $idProgress,
        ?string $siswaId,
        ?string $jadwalId,
        DateTime $tanggal,
        string $capaian,
        string $status
    ) {
        $this->idProgress = $idProgress;
        $this->siswaId = $siswaId;
        $this->jadwalId = $jadwalId;
        $this->tanggal = $tanggal;
        $this->capaian = $capaian;
        $this->status = $status;
    }

    // ======================
    // Encapsulation (Getter)
    // ======================
    public function getIdProgress(): string
    {
        return $this->idProgress;
    }

    public function getSiswaId(): ?string
    {
        return $this->siswaId;
    }

    public function getJadwalId(): ?string
    {
        return $this->jadwalId;
    }

    public function getTanggal(): DateTime
    {
        return $this->tanggal;
    }

    public function getCapaian(): string
    {
        return $this->capaian;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    // ======================
    // Method sesuai UML
    // ======================

    public function lihatDetail(string $id): Progress
    {
        // Di logic murni, kita return object ini jika id cocok.
        // Untuk versi DB, controller/repository yang cari by id.
        if ($this->idProgress !== $id) {
            throw new \RuntimeException("Progress dengan id $id tidak ditemukan pada object ini.");
        }

        return $this;
    }

    public function createProgress(Progress $p): void
    {
        // placeholder: logika bisnis sebelum disimpan (misalnya validasi status)
        $this->validasiStatus($p->status);
    }

    public function updateProgress(Progress $p): void
    {
        $this->validasiStatus($p->status);

        $this->siswaId = $p->siswaId;
        $this->jadwalId = $p->jadwalId;
        $this->tanggal = $p->tanggal;
        $this->capaian = $p->capaian;
        $this->status = $p->status;
    }

    public function deleteProgress(string $id): void
    {
        // placeholder: logika bisnis sebelum delete (misalnya cek status)
        if ($this->idProgress !== $id) {
            throw new \RuntimeException("Id tidak cocok. Tidak bisa delete progress.");
        }
    }

    // ======================
    // Helper / Business Rule
    // ======================
    private function validasiStatus(string $status): void
    {
        $allowed = ['belum', 'proses', 'selesai'];

        if (!in_array(strtolower($status), $allowed, true)) {
            throw new \InvalidArgumentException("Status tidak valid. Gunakan: belum/proses/selesai");
        }
    }
}
