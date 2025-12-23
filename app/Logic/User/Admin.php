<?php
namespace App\Logic\User;

use App\Logic\Akademik\Jadwal;
use App\Logic\Akademik\Mapel;
use App\Logic\Akademik\Progress;

class Admin extends User{
    protected Mapel $daftarMaple = [];
    protected Materi $daftarMateri = [];
    protected Guru $daftarGuru = [];
    protected Jadwal $daftarJadwal = [];

    public function kelolaMapel(Mapel $m):bool{}
    public function kelolaMateri(Materi $mt):bool{}
    public function kelolaGuru(Guru $g):bool{}
    public function kelolaJadwal(Jadwal $j):bool{}
    public function lihatProgressKelasPerMapel(Kelas $k, Mapel $m):Progress{}
}