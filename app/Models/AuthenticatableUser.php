<?php
namespace App\Models;

// Class ini tidak abstract, agar Laravel bisa memakainya untuk login
class AuthenticatableUser extends User 
{
    protected $table = 'users';

    /**
     * IMPLEMENTASI WAJIB (Agar tidak merah)
     * Memberikan nilai default untuk user umum yang login
     */
    public function getDashboardRoute(): string {
        return 'login'; // Default kembali ke login jika role tidak jelas
    }

    public function getSidebarRoleName(): string {
        return 'User Terautentikasi';
    }
}