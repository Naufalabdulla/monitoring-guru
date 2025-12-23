<?php

namespace App\Logic\User;

abstract class Guru
{
    protected string $idUser;
    protected string $nama;
    protected string $email;

    public function __construct(
        string $idUser,
        string $nama,
        string $email
    ) {
        $this->idUser = $idUser;
        $this->nama   = $nama;
        $this->email  = $email;
    }

    // ======================
    // Getter dasar (wajib)
    // ======================
    public function getIdUser(): string
    {
        return $this->idUser;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    // ======================
    // Method placeholder (kosong)
    // ======================
    // Implementasi sesungguhnya ADA di branch teman
    // Jangan isi apa pun di sini
}
