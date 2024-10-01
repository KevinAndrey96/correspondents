<?php

namespace App\UseCases\Transactions;

use App\Http\Resources\AllTransactionsByUserResource;
use App\Models\Transaction;
use App\Repositories\Contracts\Transactions\TransactionRepositoryInterface;
use App\Repositories\Contracts\Users\UserRepositoryInterface;
use App\UseCases\Contracts\Transactions\GetAllTransactionsByUserUseCaseInterface;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetAllTransactionsByUserUseCase implements GetAllTransactionsByUserUseCaseInterface
{
    protected TransactionRepositoryInterface $transactionRepository;
    protected UserRepositoryInterface $UserRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository,
                                UserRepositoryInterface $userRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    public function handle($userID): AnonymousResourceCollection
    {
        $currentDateTime = Carbon::now();
        $dateTo = $currentDateTime->format('Y-m-d');
        $dateFrom = $currentDateTime->subMonths(6)->format('Y-m-d');

        $user = $this->userRepository->getByID($userID);

        if ($user->role == 'Shopkeeper') {
            $transactions = $this->transactionRepository->getBetweenDates(true, null, null,
                $dateFrom, $dateTo, $user->id);
        }

        if ($user->role == 'Supplier') {
            $transactions = $this->transactionRepository->getBetweenDates(null, true, null,
                $dateFrom, $dateTo, $user->id);
        }

        if ($user->role == 'Distributor') {
            $transactions = $this->transactionRepository->getBetweenDates(null, null, true,
                $dateFrom, $dateTo, $user->id);
        }

        $transactions = $transactions->map(function($transaction){
            return (object)[
                'id' => $transaction->id,
                'account_number' => $transaction->account_number,
                'amount' => $transaction->amount,
                'type' => $transaction->type,
                'status' => $transaction->status,
                'detail' => $transaction->detail,
                'date' => $transaction->date,
                'voucher' => $transaction->voucher,
                'comment' => $transaction->comment,
                'product' => $transaction->product->product_name,
                'observation' => $transaction->observation,
                'created_at' => $transaction->created_at,
                'updated_at' => $transaction->updated_at
            ];
        });

        return AllTransactionsByUserResource::collection($transactions);
    }
}
