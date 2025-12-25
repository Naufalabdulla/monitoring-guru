<?php

namespace App\Models;

use App\Contracts\UserInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Abstract tidak bisa diinstansiasi langsung (new User)
 */
abstract class User extends Authenticatable implements UserInterface
{
    use HasFactory, Notifiable;

    protected $table = 'users'; 
    protected $fillable = ['nama', 'email', 'password', 'role'];

    // Method Polimorfik: dideklarasikan di parent, diisi di anak
    abstract public function getDashboardRoute(): string;
    abstract public function getSidebarRoleName(): string;

    public function updateProfile(array $data) {
        return $this->update($data);
    }
}