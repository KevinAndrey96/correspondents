<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\Contracts\Users\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getEnabledSuppliersRegardlessOfBalance()
    {
        return User::where([
            ['role', 'Supplier'],
            ['is_online', 1],
            ['is_enabled', 1]
        ])
            ->orderBy('priority', 'asc')
            ->get();
    }

    public function getEnabledSuppliersWithEnoughBalance(float $amount)
    {
        return User::where([
            ['role', '=', 'Supplier'],
            ['is_online', '=', 1],
            ['is_enabled', '=', 1],
            ['balance', '>=', $amount]
        ])
            ->orderBy('priority', 'asc')
            ->get();
    }
}
