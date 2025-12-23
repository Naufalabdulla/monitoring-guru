<?php
namespace App\Models;


class Guru extends User  {
    // Relasi tetap ada dan spesifik untuk Guru
    public function mapels() { return $this->hasMany(Mapel::class, 'user_id'); }
    public function jadwals() { return $this->hasMany(Jadwal::class, 'guru_id'); }

    public function lihatDaftarMapel() { return $this->mapels; }
    public function lihatMateriPerMapel($mapel_id) { 
        return Materi::where('mapel_id', $mapel_id)->get(); 
    }
    public function lihatJadwalMengajar() { return $this->jadwals; }
    public function updateProgress($progress_id, array $data): bool {
        return ProgressPembelajaran::findOrFail($progress_id)->update($data);
    }
}