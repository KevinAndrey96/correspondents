<?php

namespace App\Repositories\Transactions;

use App\DTOs\Transactions\CreateTransactionDTO;
use App\Models\Transaction;
use App\Repositories\Contracts\Transactions\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function store(CreateTransactionDTO $DTO): Transaction
    {
        $transaction = new Transaction();
        $transaction->shopkeeper_id = $DTO->shopkeeper->id;
        $transaction->distributor_id = $DTO->shopkeeper->distributor->id;
        $transaction->admin_id = 1;
        $transaction->account_number = $DTO->accountNumber;
        $transaction->product_id = $DTO->productID;
        $transaction->amount = $DTO->amount;
        $transaction->type = $DTO->type;
        $transaction->status = $DTO->status;
        $transaction->detail = $DTO->detail;
        $transaction->date = $DTO->date;
        $transaction->userIP = $DTO->userIP;
        $transaction->own_commission = $DTO->ownCommission;
        $transaction->save();

        return $transaction;
    }

    public function update(Transaction $transaction, ?string $status, ?int $firstTransaction, ?int $supplierID): Transaction
    {
        if (isset($status)) {
            $transaction->status = $status;
            $transaction->save();
        }

        if (isset($firstTransaction)) {
            $transaction->first_transaction = $firstTransaction;
            $transaction->save();
        }

        if (isset($supplierID)) {
            $transaction->supplier_id = $supplierID;
            $transaction->save();
        }

        return $transaction;
    }

    public function delete(Transaction $transaction): bool
    {
        $transaction->delete();

        return true;
    }

    public function getByID(int $id): Transaction
    {
        return Transaction::find($id);
    }

    public function getFirstTransactionsByAccountNumber(string $accountNumber, int $productID)
    {
        return Transaction::where([
            ['account_number', $accountNumber],
            ['product_id', $productID],
            ['first_transaction', '=', 1]
        ])->get();
    }

    public function getByAccountNumber(string $accountNumber, int $productID)
    {
        return Transaction::where([
            ['account_number', $accountNumber],
            ['product_id', $productID]
        ])
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function getHoldTransactionsBySupplierID(int $userID)
    {
        return Transaction::where([
            ['supplier_id', $userID],
            ['status', '=', 'hold']
        ])->get();
    }

    public function getBetweenDates(?bool $shopkeeper, ?bool $supplier, ?bool $distributor,
                                    string $dateFrom, string $dateTo, int $userID)
    {
        if (isset($shopkeeper)) {
            $transactions = Transaction::where('shopkeeper_id', $userID)
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->orderBy('id', 'desc')
                ->get();
        }

        if (isset($supplier)) {
            $transactions = Transaction::where('supplier_id', $userID)
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->orderBy('id', 'desc')
                ->get();
        }

        if (isset($distributor)) {
            $transactions = Transaction::where('distributor_id', $userID)
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->orderBy('id', 'desc')
                ->get();
        }

        if (is_null($distributor) && is_null($shopkeeper) && is_null($supplier)) {
            $transactions = Transaction::where('admin_id', $userID)
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->orderBy('id', 'desc')
                ->get();
        }

        return $transactions;
    }
}
