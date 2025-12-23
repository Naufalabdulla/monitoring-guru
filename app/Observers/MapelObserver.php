<?php

namespace App\Observers;

use App\Models\Mapel;

class MapelObserver
{
    /**
     * Handle the Mapel "created" event.
     */
    public function created(Mapel $mapel): void
    {
        $pertemuans = [];

        // Generate Minggu 1 sampai 16
        for ($i = 1; $i <= 16; $i++) {
            $pertemuans[] = ['pertemuan' => "Minggu $i"];
        }

        // Tambah Indikator Ujian
        $pertemuans[] = ['pertemuan' => 'UTS'];
        $pertemuans[] = ['pertemuan' => 'UAS'];
        $pertemuans[] = ['pertemuan' => 'Ujian Akhir'];

        foreach ($pertemuans as $p) {
            $mapel->progressPembelajaran()->create([
                'pertemuan' => $p['pertemuan'],
                'status' => 0
            ]);
        }
    }

    /**
     * Handle the Mapel "updated" event.
     */
    public function updated(Mapel $mapel): void
    {
        //
    }

    /**
     * Handle the Mapel "deleted" event.
     */
    public function deleted(Mapel $mapel): void
    {
        //
    }

    /**
     * Handle the Mapel "restored" event.
     */
    public function restored(Mapel $mapel): void
    {
        //
    }

    /**
     * Handle the Mapel "force deleted" event.
     */
    public function forceDeleted(Mapel $mapel): void
    {
        //
    }
}
