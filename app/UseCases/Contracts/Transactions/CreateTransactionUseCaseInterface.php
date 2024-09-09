<?php

namespace App\UseCases\Contracts\Transactions;

use App\DTOs\Transactions\CreateTransactionDTO;

interface CreateTransactionUseCaseInterface
{
    public function handle(CreateTransactionDTO $DTO);
}
