<?php

namespace App\UseCases\Contracts\Transactions;

use App\Models\Product;
use App\Models\Transaction;

interface ValidateLimitOfTransactionsByAccountUseCaseInterface
{
    public function handle(Transaction $transaction, Product $product, string $accountNumber);
}
