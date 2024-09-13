<?php

namespace App\UseCases\Transactions;

use App\DTOs\Transactions\CreateTransactionDTO;
use App\Models\SupplierProduct;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Transactions\TransactionRepositoryInterface;
use App\Repositories\Contracts\Users\UserRepositoryInterface;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Transactions\TransactionRepository;
use App\UseCases\Contracts\Transactions\CreateTransactionUseCaseInterface;
use Carbon\Carbon;

class CreateTransactionUseCase implements CreateTransactionUseCaseInterface
{


    protected TransactionRepositoryInterface $transactionRepository;
    protected ProductRepositoryInterface $productRepository;
    protected UserRepositoryInterface $userRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository,
                                ProductRepositoryInterface $productRepository,
                                UserRepositoryInterface $userRepository,
    )
    {
      $this->transactionRepository = $transactionRepository;
      $this->productRepository = $productRepository;
      $this->userRepository = $userRepository;
    }

    public function handle(CreateTransactionDTO $DTO)
    {
        $transaction = $this->transactionRepository->store($DTO);
        $product = $this->productRepository->getByID($transaction->product_id);

        $allowedTransaction = 0;
        $transactionsCount = 0;
        $firstTransactions =  $this->transactionRepository->getFirstTransactionsByAccountNumber($transaction->account_number, $transaction->product_id);

        if ($firstTransactions->count() == 0) {
            $this->transactionRepository->update($transaction, null, 1, null);
            $allowedTransaction = 1;
        } else {
            $accountTransactions = $this->transactionRepository->getByAccountNumber($transaction->account_number, $transaction->product_id);

            foreach ($accountTransactions as $accountTransaction) {
                $transactionsCount++;
                if ($accountTransaction->first_transaction == 1) {
                    $firstTransaction = $accountTransaction;
                    break;
                }
            }

            if ($transactionsCount < $product->num_jineteo) {
                $diffHours = $firstTransaction->updated_at->diffInHours(Carbon::now());
                if ($diffHours >= $product->hours) {
                    $allowedTransaction = 1;
                    $this->transactionRepository->update($transaction, null, 1, null);
                } else {
                    $allowedTransaction = 1;
                    $this->transactionRepository->update($transaction, null, 0, null);
                }
            } else {
                $diffHours = $firstTransaction->updated_at->diffInHours(Carbon::now());
                if ($diffHours >= $product->hours) {
                    $allowedTransaction = 1;
                    $this->transactionRepository->update($transaction, null, 1, null);
                } else {
                    $allowedTransaction = 0;
                    $allowedHour = Carbon::parse($firstTransaction->updated_at)->addHours($product->hours)->format('h:i A');
                }
            }
        }

        if ($allowedTransaction == 0) {
            $this->transactionRepository->update($transaction, 'cancelled', null, null);
            return [
                'transactionID' => $transaction->id,
                'message' => 'Esta cuenta superó el límite de transacciones por periodo, podra realizar transacciones con la misma a partir de las '.$allowedHour
            ];
        }

        if ($transaction->type == 'Withdrawal') {
            $suppliers = $this->userRepository->getEnabledSuppliersRegardlessOfBalance();
        } else {
            $suppliers = $this->userRepository->getEnabledSuppliersWithEnoughBalance($transaction->amount);
        }

        if (! $suppliers->count()) {
            $this->transactionRepository->update($transaction, 'cancelled', null, null);
            return [
                'transactionID' => $transaction->id,
                'message' => 'No hay proveedores disponibles'
            ];
        }

        foreach ($suppliers as $supplier) {
            $supplierProduct = $this->productRepository->getByUserID($product->id, $supplier->id);

            if ($supplierProduct->count() > 0) {
                $transactions = $this->transactionRepository->getHoldTransactionsBySupplierID($supplier->id);
                $numTransactions = $transactions->count();
                if ($supplier->max_queue > $numTransactions) {
                    $transaction->supplier_id = $supplier->id;
                    $transaction->save();
                    break;
                }
            }
        }

        return [
            'transactionID' => $transaction->id,
            'message' => 'Transacción asignada a proveedor'
        ];

    }
}
