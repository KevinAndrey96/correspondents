<?php

namespace App\Repositories\Contracts\Transactions;

use App\DTOs\Transactions\CreateTransactionDTO;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function store(CreateTransactionDTO $DTO): Transaction;
    public function getFirstTransactionsByAccountNumber(string $accountNumber, int $productID);
    public function getByAccountNumber(string $accountNumber, int $productID);
    public function update(Transaction $transaction, ?string $status, ?int $firstTransaction, ?int $supplierID): Transaction;

    public function delete(Transaction $transaction): bool;
    public function getHoldTransactionsBySupplierID(int $userID);

    public function getByID(int $id): Transaction;
}
