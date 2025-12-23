<?php
namespace App\Models;

// Class ini tidak abstract, agar Laravel bisa memakainya untuk login
class AuthenticatableUser extends User 
{
    protected $table = 'users';
}