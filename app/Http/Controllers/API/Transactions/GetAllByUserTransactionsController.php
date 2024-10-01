<?php

namespace App\Http\Controllers\API\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Repositories\Contracts\Transactions\TransactionRepositoryInterface;
use App\Repositories\Contracts\Users\UserRepositoryInterface;
use App\UseCases\Contracts\Transactions\CreateTransactionUseCaseInterface;
use App\UseCases\Contracts\Transactions\GetAllTransactionsByUserUseCaseInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetAllByUserTransactionsController extends Controller
{
    protected GetAllTransactionsByUserUseCaseInterface $getAllTransactionsByUserUseCase;

    public function __construct(GetAllTransactionsByUserUseCaseInterface $getAllTransactionsByUserUseCase)
    {
        $this->getAllTransactionsByUserUseCase = $getAllTransactionsByUserUseCase;
    }



    public function __invoke(int $id)
    {
        return $this->getAllTransactionsByUserUseCase->handle($id);
    }
}
