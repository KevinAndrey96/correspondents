<?php

namespace App\UseCases\Transactions;

use App\Http\Resources\TransactionDetailResource;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Transactions\TransactionRepositoryInterface;
use App\Repositories\Products\ProductRepository;
use App\UseCases\Contracts\Transactions\GetTransactionDetailUseCaseInterface;
use stdClass;

class GetTransactionDetailUseCase implements  GetTransactionDetailUseCaseInterface
{
    protected ProductRepositoryInterface $productRepository;
    protected TransactionRepositoryInterface $transactionRepository;

    public function __construct(ProductRepositoryInterface $productRepository,
                                TransactionRepositoryInterface $transactionRepository)
    {
        $this->productRepository = $productRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function handle(int $id): TransactionDetailResource
    {
        $transaction = $this->transactionRepository->getByID($id);
        $transactionData = new stdClass();
        $transactionData->transactionID = $transaction->id;
        $transactionData->transactionStatus = $transaction->status;
        $transactionData->accountNumber = $transaction->account_number;
        $transactionData->transactionType = $transaction->type;
        $transactionData->transactionDetail = $transaction->detail;
        $transactionData->transactionAmount = $transaction->amount;
        $transactionData->productName = $transaction->product->product_name;
        $transactionData->productID = $transaction->product->id;


        return new TransactionDetailResource($transactionData);


    }
}
