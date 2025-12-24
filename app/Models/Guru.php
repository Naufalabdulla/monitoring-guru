<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\{Materi, Mapel};


class Guru extends User
{
    // ===== UML: lihatDaftarMapel =====
public function buatMateri(Materi $materi): void
{
    // Pastikan mapel milik guru ini
    $mapel = Mapel::where('id', $materi->mapel_id)
        ->where('user_id', $this->id)
        ->first();

    if (!$mapel) {
        throw new \RuntimeException('Mapel bukan milik guru ini.');
    }

    $materi->save();
}

public function updateMateri(Materi $materi, array $data): void
{
    // Pastikan materi ini milik guru ini (lewat mapel)
    $mapel = Mapel::where('id', $materi->mapel_id)
        ->where('user_id', $this->id)
        ->first();

    if (!$mapel) {
        throw new \RuntimeException('Tidak punya izin mengubah materi ini.');
    }

    $materi->update([
        'nama' => $data['nama'] ?? $materi->nama,
        'mapel_id' => $data['mapel_id'] ?? $materi->mapel_id,
        'deskripsi' => $data['deskripsi'] ?? $materi->deskripsi,
        'file_pendukung' => $data['file_pendukung'] ?? $materi->file_pendukung,
    ]);
}
    // ===== UML: hapusMateri =====
    public function hapusMateri(Materi $materi): void
{
    $mapel = Mapel::where('id', $materi->mapel_id)
        ->where('user_id', $this->id)
        ->first();

    if (!$mapel) {
        throw new \RuntimeException('Tidak punya izin menghapus materi ini.');
    }

    $materi->delete();
}


    public function lihatDaftarMapel()
    {
        return Mapel::where('user_id', $this->id)->get();
    }

    // ===== UML: lihatMapel =====
    public function lihatMapel($mapel_id)
    {
        return Mapel::where('id', $mapel_id)
            ->where('user_id', $this->id)
            ->firstOrFail();
    }

    // ===== UML: lihatProgressMapel =====
    public function lihatProgressMapel($mapel_id)
    {
        $progress = ProgressPembelajaran::where('mapel_id', $mapel_id)->get();

        // auto-generate jika kosong (sesuai UML kamu)
        if ($progress->isEmpty()) {
            $list = array_merge(
                array_map(fn($i) => "Minggu $i", range(1, 16)),
                ['UTS', 'UAS', 'Ujian Akhir']
            );

            foreach ($list as $p) {
                ProgressPembelajaran::create([
                    'mapel_id' => $mapel_id,
                    'pertemuan' => $p,
                    'status' => 0,
                ]);
            }

            $progress = ProgressPembelajaran::where('mapel_id', $mapel_id)->get();
        }

        return $progress;
    }

    // ===== UML: updateProgress =====
    public function updateProgress($progress_id, array $data)
{
    $progress = ProgressPembelajaran::findOrFail($progress_id);

    // pastikan progress ini milik mapel guru ini
    $mapel = Mapel::where('id', $progress->mapel_id)
        ->where('user_id', $this->id)
        ->first();

    if (!$mapel) {
        throw new \RuntimeException('Tidak punya izin mengubah progress ini.');
    }

    $progress->update([
        'status' => $data['status'],
        'materi' => $data['materi'] ?? null,
    ]);
}


    // ===== UML: lihatJadwalHariIni =====
    public function lihatJadwalHariIni(string $hari)
    {
        return Jadwal::where('guru_id', $this->id)
            ->where('hari', $hari)
            ->with(['mapel', 'kelas'])
            ->get();
    }

    // ===== UML: lihatJadwalMingguan =====
    public function lihatJadwalMingguan()
    {
        return Jadwal::where('guru_id', $this->id)
            ->with(['mapel', 'kelas'])
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->get()
            ->groupBy('hari');
    }
}
