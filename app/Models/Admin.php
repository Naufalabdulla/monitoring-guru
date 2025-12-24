<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends User // atau extends Authenticatable sesuai punyamu
{
    // pastikan fillable ada di model User/Admin untuk kolom user

    // ====== UML: kelolaKelas() ======
    public function kelolaKelas(Kelas $kelas): void
    {
        // contoh rule sederhana (boleh kamu sesuaikan)
        if (empty($kelas->nama)) {
            throw new \InvalidArgumentException('Nama kelas tidak boleh kosong.');
        }

        // kalau object belum tersimpan, simpan
        $kelas->save();
    }

    // ====== UML: hapusKelas() ======
    public function hapusKelas(Kelas $kelas): void
    {
        $kelas->delete();
    }

    // ====== UML: kelolaMapel() (punyamu sudah ada, tapi kalau belum) ======
    public function kelolaMapel(Mapel $m): bool {
        return $m->save(); // Inilah yang memasukkan data ke tabel mapels
    }
    
    public function hapusMapel(Mapel $m): bool {
        return $m->delete();
    }

    // ====== UML: kelolaMateri() ======
    public function kelolaMateri(Materi $materi): void
    {
        if (empty($materi->nama)) {
            throw new \InvalidArgumentException('Nama materi tidak boleh kosong.');
        }

        $materi->save();
    }

    public function hapusMateri(Materi $materi): void
    {
        $materi->delete();
    }

    // ====== UML: kelolaJadwal() ======
    public function kelolaJadwal(Jadwal $jadwal): void
    {
        // rule jam mulai < jam selesai (sesuai logic Jadwal kamu)
        if ($jadwal->jam_mulai >= $jadwal->jam_selesai) {
            throw new \InvalidArgumentException('Jam mulai harus lebih kecil dari jam selesai.');
        }

        $jadwal->save();
    }

    public function hapusJadwal(Jadwal $jadwal): void
    {
        $jadwal->delete();
    }

    // ====== UML: kelolaGuru() ======
    public function kelolaGuru(Guru $guru): void
    {
        if (empty($guru->email)) {
            throw new \InvalidArgumentException('Email tidak boleh kosong.');
        }

        $guru->save();
    }
}
