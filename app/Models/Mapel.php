<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    // Pastikan fillable mencakup foreign key
    protected $fillable = ['nama', 'kelas_id', 'user_id', 'deskripsi'];

    /**
     * RELASI UTAMA: Menghubungkan Mapel ke Kelas
     * Inilah yang dicari oleh AdminController::with(['kelas'])
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * RELASI GURU: Menghubungkan Mapel ke User (Guru)
     */
   public function guru(): BelongsTo
    {
        // PERBAIKAN: Gunakan class konkrit agar tidak error abstract
        return $this->belongsTo(AuthenticatableUser::class, 'user_id');
    }
    /**
     * RELASI MATERI: Sesuai komposisi di Class Diagram
     */
    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class, 'mapel_id');
    }

    /**
     * RELASI PROGRESS: Menghubungkan Mapel ke Tabel Progress
     */
    public function progress(): HasMany
    {
        return $this->hasMany(ProgressPembelajaran::class, 'mapel_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Metode Tambahan Sesuai Class Diagram
    |--------------------------------------------------------------------------
    */
    public static function getMapelById($id) { 
        return self::find($id); 
    }

    public function getPersentaseAttribute() {
        $total = 19; 
        $selesai = $this->progress()->where('status', 1)->count();
        return ($selesai / $total) * 100;
    }
}