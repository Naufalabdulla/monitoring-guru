<?php

namespace App\Logic\Akademik;

class Progress
{
    // Atribut Private sesuai Diagram (-)
    private string $idProgress;
    private int $pertemuan; // Pertemuan 1-16
    private string $status;
    private ?Materi $materi; // Komposisi: Progress memiliki Materi

    public function __construct(string $id, int $pertemuan, string $status, ?Materi $materi = null)
    {
        $this->idProgress = $id;
        $this->pertemuan = $pertemuan;
        $this->status = $status;
        $this->materi = $materi;
    }

    // + lihatDetail(id: String): Progress
    public function lihatDetail(string $id): Progress
    {
        return $this;
    }

    // Getter untuk enkapsulasi
    public function getPertemuan(): int { return $this->pertemuan; }
    public function getStatus(): string { return $this->status; }
    public function getMateri(): ?Materi { return $this->materi; }
}