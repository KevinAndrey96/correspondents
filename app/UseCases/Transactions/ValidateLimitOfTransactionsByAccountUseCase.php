<?php

namespace App\UseCases\Transactions;

use App\Models\Product;
use App\Models\Transaction;
use App\UseCases\Contracts\Transactions\ValidateLimitOfTransactionsByAccountUseCaseInterface;
use Carbon\Carbon;

class ValidateLimitOfTransactionsByAccountUseCase implements ValidateLimitOfTransactionsByAccountUseCaseInterface
{
    public function handle(Transaction $transaction, Product $product, string $accountNumber)
    {
        $allowedTransaction = 0;
        $i = 0;
        $firstTransactions =  Transaction::where([
            ['account_number', '=', $accountNumber],
            ['product_id', '=', $product->id],
            ['first_transaction', '=', 1]
        ])->get();

        if ($firstTransactions->count() == 0) {
            $transaction->first_transaction = 1;
            $allowedTransaction = 1;
        } else {
            $accountTransactions = Transaction::where([
                ['account_number', '=', $accountNumber],
                ['product_id', '=', $product->id]
            ])
                ->orderBy('updated_at', 'desc')
                ->get();

            foreach ($accountTransactions as $accountTransaction) {
                $i++;
                if ($accountTransaction->first_transaction == 1) {
                    $firstTransaction = $accountTransaction;
                    break;
                }
            }

            if ($i < $product->num_jineteo) {
                $diffHours = $firstTransaction->updated_at->diffInHours(Carbon::now());
                if ($diffHours >= $product->hours) {
                    $allowedTransaction = 1;
                    $transaction->first_transaction = 1;
                } else {
                    $allowedTransaction = 1;
                    $transaction->first_transaction = 0;
                }
            } else {
                $diffHours = $firstTransaction->updated_at->diffInHours(Carbon::now());
                if ($diffHours >= $product->hours) {
                    $allowedTransaction = 1;
                    $transaction->first_transaction = 1;
                } else {
                    $allowedTransaction = 0;
                    $allowedHour = Carbon::parse($firstTransaction->updated_at)->addHours($product->hours)->format('h:i A');
                }
            }
        }

        if ($allowedTransaction == 0) {
            if (isset($giros)) {
                return redirect('/giros/create?giros=1')->with('LimitExceeded', 'Esta cuenta superó el límite de giros por periodo, podra realizar giros con la misma a partir de las '.$allowedHour);
            } else {
                return redirect('/transactions')->with('LimitExceeded', 'Esta cuenta superó el límite de transacciones por periodo, podra realizar transacciones con la misma a partir de las '.$allowedHour);
            }
        }

    }


}
