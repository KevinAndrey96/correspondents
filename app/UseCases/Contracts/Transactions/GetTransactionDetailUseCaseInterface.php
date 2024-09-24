<?php

namespace App\UseCases\Contracts\Transactions;

use App\Http\Resources\TransactionDetailResource;

interface GetTransactionDetailUseCaseInterface
{
    public function handle(int $id): TransactionDetailResource;
}
