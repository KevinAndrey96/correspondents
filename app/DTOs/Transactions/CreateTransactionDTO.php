<?php

namespace App\DTOs\Transactions;

use App\Models\User;

class CreateTransactionDTO
{
    public User $shopkeeper;
    public int $productID;
    public string $accountNumber;
    public float $amount;
    public string $type;
    public string $status;
    public ?string $detail;
    public ?string $date;
    public ?float $ownCommission;
    public ?string $userIP;

}
