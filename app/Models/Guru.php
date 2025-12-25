<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class Guru extends User
{
    /**
     * ATRIBUT (Sesuai Diagram # / Protected)
     * Mewakili ArrayList pada diagram
     */
    protected $mapelDiampu; 
    protected $jadwalMengajar;

    /**
     * METHOD (+ / Public)
     */

    // + lihatDaftarMapel(): ArrayList<Mapel>
    public function lihatDaftarMapel(): Collection
    {
        return Mapel::where('user_id', $this->id)->with('kelas')->get();
    }

    // + lihatMateriPerMapel(m: Mapel): ArrayList<Materi>
    public function lihatMateriPerMapel(Mapel $mapel): Collection
    {
        return Materi::where('mapel_id', $mapel->id)->get();
    }

    // + lihatJadwalMengajar(): ArrayList<jadwal>
    public function lihatJadwalMengajar(): Collection
    {
        return Jadwal::where('guru_id', $this->id)
            ->with(['mapel', 'kelas'])
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->get();
    }

    // + lihatProgressHariIni(j: Jadwal): ArrayList<Progress>
    public function lihatProgressHariIni(Jadwal $jadwal): Collection
    {
        // Mengambil progress berdasarkan mata pelajaran yang ada di jadwal tersebut
        return ProgressPembelajaran::where('mapel_id', $jadwal->mapel_id)->get();
    }

    // + updateProgress(p: Progress): Boolean
    public function updateProgress(ProgressPembelajaran $p, array $data): bool
    {
        return $p->update([
            'status' => $data['status'],
            'materi' => $data['materi'] ?? $p->materi
        ]);
    }

    /** * METHOD TAMBAHAN (Untuk mendukung operasional Controller)
     */
    public function buatMateri(Materi $m): bool { return $m->save(); }
    public function hapusMateri(Materi $m): bool { return $m->delete(); }
    public function updateMateri(Materi $m, array $data): bool { return $m->update($data); }
    public function getDashboardRoute(): string {
        return 'guru.dashboard';
    }

    public function getSidebarRoleName(): string {
        return 'Tenaga Pengajar - ' . $this->nama;
    }
}