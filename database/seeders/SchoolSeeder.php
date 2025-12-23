<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA GURU (Satu Kata)
        $namaGuru = [
            'Budi', 'Siti', 'Agus', 'Lani', 'Eko', 
            'Rina', 'Dedi', 'Maya', 'Tono', 'Dewi', 
            'Andi', 'Sari', 'Rian', 'Hana', 'Gani'
        ];

        foreach ($namaGuru as $nama) {
            User::updateOrCreate(
                ['email' => strtolower($nama) . '@sekolah.sch.id'],
                [
                    'nama' => $nama,
                    'password' => Hash::make('password'),
                    'role' => 'guru'
                ]
            );
        }

        $guruIds = User::where('role', 'guru')->pluck('id')->toArray();

        // 2. DATA KELAS (10, 11, 12 | IPA & IPS 1-3)
        $tingkats = ['10', '11', '12'];
        $jurusans = ['IPA', 'IPS'];
        
        foreach ($tingkats as $t) {
            foreach ($jurusans as $j) {
                for ($i = 1; $i <= 3; $i++) {
                    Kelas::updateOrCreate([
                        'nama' => "$t $j $i",
                        'tingkat' => $t
                    ]);
                }
            }
        }

        $allKelas = Kelas::all();

        // 3. DATA MAPEL (Umum, IPA, dan IPS)
        $mapelUmum = ['Agama', 'PKN', 'B.Indonesia', 'B.Inggris', 'Sejarah', 'Penjas', 'Seni'];
        $mapelIPA  = ['Matematika', 'Fisika', 'Biologi', 'Kimia'];
        $mapelIPS  = ['Ekonomi', 'Geografi', 'Sosiologi', 'Sejarah Minat'];

        foreach ($allKelas as $kelas) {
            // Gabungkan Mapel Umum dengan Mapel Jurusan
            $daftarMapel = $mapelUmum;
            if (str_contains($kelas->nama, 'IPA')) {
                $daftarMapel = array_merge($daftarMapel, $mapelIPA);
            } else {
                $daftarMapel = array_merge($daftarMapel, $mapelIPS);
            }

            foreach ($daftarMapel as $mName) {
                $mapel = Mapel::updateOrCreate([
                    'nama' => $mName,
                    'kelas_id' => $kelas->id,
                    'user_id' => $guruIds[array_rand($guruIds)] // Acak guru dari list
                ]);

                // 4. DATA MATERI (2 Materi per Mapel)
                for ($m = 1; $m <= 2; $m++) {
                    Materi::create([
                        'nama' => "Bab $m: Materi $mName",
                        'deskripsi' => "Deskripsi lengkap untuk materi $mName Bab $m kelas " . $kelas->nama,
                        'file_pendukung' => "file_materi_$m.pdf",
                        'mapel_id' => $mapel->id
                    ]);
                }
            }
        }

        // 5. DATA JADWAL (Senin - Jumat)
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamSlots = [
            ['07:00:00', '08:30:00'],
            ['08:30:00', '10:00:00'],
            ['10:30:00', '12:00:00']
        ];

        foreach ($allKelas as $kelas) {
            $mapelsDiKelas = Mapel::where('kelas_id', $kelas->id)->get();
            $mapelIndex = 0;

            foreach ($haris as $hari) {
                foreach ($jamSlots as $jam) {
                    if (isset($mapelsDiKelas[$mapelIndex])) {
                        $currentMapel = $mapelsDiKelas[$mapelIndex];
                        
                        Jadwal::create([
                            'kelas_id'    => $kelas->id,
                            'mapel_id'    => $currentMapel->id,
                            'guru_id'     => $currentMapel->user_id,
                            'hari'        => $hari,
                            'jam_mulai'   => $jam[0],
                            'jam_selesai' => $jam[1],
                        ]);
                        
                        $mapelIndex++;
                        // Jika mapel habis, ulangi dari awal (rotasi)
                        if ($mapelIndex >= $mapelsDiKelas->count()) {
                            $mapelIndex = 0;
                        }
                    }
                }
            }
        }
    }
}