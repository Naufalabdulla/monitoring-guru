<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class Admin extends User
{
    /**
     * ATRIBUT PRIVATE (Sesuai Diagram -)
     */
    private $daftarMapel;
    private $daftarMateri;
    private $daftarGuru;
    private $daftarSiswa;
    private $daftarJadwal;

    /**
     * METHOD (+ public) 
     */

    // + kelolaMapel(m: Mapel): Boolean
    public function kelolaMapel(Mapel $m): bool
    {
        return $m->save();
    }

    // + kelolaMateri(mt: Materi): Boolean
    public function kelolaMateri(Materi $mt): bool
    {
        return $mt->save();
    }

    // + kelolaGuru(g: Guru): Boolean
    public function kelolaGuru(Guru $g): bool
    {
        return $g->save();
    }

    // + kelolaJadwal(j: Jadwal): Boolean
    public function kelolaJadwal(Jadwal $j): bool
    {
        return $j->save();
    }

    // + lihatProgressKelasPerMapel(k: Kelas, m: Mapel): ArrayList<Progress>
    // Diperbaiki: Digabung agar tidak duplikat dan menggunakan eager loading
    public function lihatProgressKelasPerMapel(Kelas $k, Mapel $m): Collection
    {
        return ProgressPembelajaran::where('mapel_id', $m->id)
            ->with('materi') // Sesuai permintaan Anda untuk melihat materi
            ->orderBy('pertemuan')
            ->get();
    }

    // + lihatDetailProgress(p: Progress): Progress
    // Diperbaiki: Digabung agar tidak duplikat
    public function lihatDetailProgress(ProgressPembelajaran $p): ProgressPembelajaran
    {
        return $p->load(['materi', 'mapel.guru']); 
    }

    /**
     * IMPLEMENTASI POLIMORFISME (Dari User Abstract)
     */
    public function getDashboardRoute(): string
    {
        return 'admin.dashboard';
    }

    public function getSidebarRoleName(): string
    {
        return 'Administrator Sistem';
    }

    /**
     * Method tambahan untuk penghapusan
     */
    public function hapusMapel(Mapel $m): bool { return $m->delete(); }
    public function hapusMateri(Materi $m): bool { return $m->delete(); }
    public function hapusJadwal(Jadwal $j): bool { return $j->delete(); }
}