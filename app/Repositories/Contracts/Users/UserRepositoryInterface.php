<?php

namespace App\Repositories\Contracts\Users;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getEnabledSuppliersRegardlessOfBalance();
    public function getEnabledSuppliersWithEnoughBalance(float $amount);

    public function getByID(int $id): User;
}
