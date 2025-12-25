<?php

namespace App\Logic\Akademik;

/**
 * Class Logic Materi (Simulasi OOP Murni)
 */
class Materi
{
    /**
     * ATRIBUT (Sesuai Diagram - / Private)
     */
    private string $idMateri;
    private string $judul;
    private string $konten;

    /**
     * Konstruktor untuk inisialisasi objek
     */
    public function __construct(string $id, string $judul, string $konten)
    {
        $this->idMateri = $id;
        $this->judul    = $judul;
        $this->konten   = $konten;
    }

    // ==========================================
    // GETTER (Akses Data Private dari Luar)
    // ==========================================
    public function getIdMateri(): string { return $this->idMateri; }
    public function getJudul(): string    { return $this->judul; }
    public function getKonten(): string   { return $this->konten; }

    /**
     * METHOD UML (+ / Public)
     */

    // + createMateri(m: Materi): void
    public function createMateri(Materi $m): void
    {
        // Logika simulasi pembuatan materi (misal: disimpan ke array/list)
    }

    // + getMateriById(id: String): Materi
    public function getMateriById(string $id): Materi
    {
        // Logika simulasi pencarian materi berdasarkan ID
        return $this; 
    }

    // + updateMateri(m: Materi): void
    public function updateMateri(Materi $m): void
    {
        // Sinkronisasi data dari parameter ke objek ini
        $this->judul  = $m->judul;
        $this->konten = $m->konten;
    }

    // + deleteMateri(id: String): void
    public function deleteMateri(string $id): void
    {
        // Logika simulasi penghapusan materi
    }
}