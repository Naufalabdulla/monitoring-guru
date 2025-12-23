<?php
namespace App\Logic\User;

use phpDocumentor\Reflection\Types\Boolean;

abstract class User{
    private string $idUser;
    private string $nama;
    private string $email;
    private string $password;

    public function login(string $email, string $password):bool {
        return true;
    }

    public function logout():void{}
    public function updateProfile():bool{
        return false;
    }
}