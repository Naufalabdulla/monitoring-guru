<?php

namespace App\Logic\User;

use Illuminate\Support\Collection;

class Guru
{
    protected string $idUser;
    protected string $nama;
    protected string $email;
    
    // Visibilitas Protected (#)
    protected Collection $mapelDiampu;
    protected Collection $jadwalMengajar;

    public function __construct(string $idUser, string $nama, string $email) {
        $this->idUser = $idUser;
        $this->nama   = $nama;
        $this->email  = $email;
        $this->mapelDiampu = collect(); 
        $this->jadwalMengajar = collect();
    }

    // Getter tetap public (+)
    public function getNama(): string { return $this->nama; }
}