<?php
namespace App\Models;

use App\Contracts\AdminInterface;

class Admin extends User  {
    // Implementasi ArrayList di diagram sebagai Accessor
    public function getDaftarGuruAttribute() { return User::where('role', 'guru')->get(); }
    public function getDaftarMapelAttribute() { return Mapel::all(); }

    public function kelolaMapel(Mapel $m): bool { return $m->save(); }
    public function kelolaMateri(Materi $mt): bool { return $mt->save(); }
    public function kelolaGuru(User $g): bool { return $g->save(); }
    public function kelolaJadwal(Jadwal $j): bool { return $j->save(); }

    public function lihatProgressKelasPerMapel($kelas_id, $mapel_id) {
        return ProgressPembelajaran::where('mapel_id', $mapel_id)->get();
    }
    public function lihatDetailProgress($progress_id) {
        return ProgressPembelajaran::findOrFail($progress_id);
    }
}