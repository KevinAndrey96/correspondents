<?php

namespace App\UseCases\Contracts\Transactions;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface GetAllTransactionsByUserUseCaseInterface
{
    public function handle($userID): AnonymousResourceCollection;
}
