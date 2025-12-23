<?php
namespace App\Contracts;

/**
 * Interface mendefinisikan kontrak metode yang wajib ada
 */
interface UserInterface {
    public function updateProfile(array $data);
}