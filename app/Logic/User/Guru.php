<?php
namespace App\Logic\User;

use App\Logic\Akademik\Jadwal;
use App\Logic\Akademik\Mapel;
use App\Logic\Akademik\Materi;

class Guru extends User{
    protected Mapel $mapelDiampu = [];
    protected Jadwal $jadwalMengajar = [];

    public function lihatDaftarMateri():Mapel{
        // return ;
    }

    public function lihatMateriPerMapel(Mapel $m): Materi{
        // return ;
    }

    public function lihatJadwalMengajar(): Jawal{}

    public function lihatProgressHariIni(Jadwal $j): Progress{}
    public function updateProgress(Progress $p):bool{}
}