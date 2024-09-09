<?php

namespace App\Repositories\Contracts\Users;

interface UserRepositoryInterface
{
    public function getEnabledSuppliersRegardlessOfBalance();
    public function getEnabledSuppliersWithEnoughBalance(float $amount);
}
