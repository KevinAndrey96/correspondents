<?php

namespace App\Http\Controllers\API\Transactions;

use App\DTOs\Transactions\CreateTransactionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTransactionRequest;
use App\Models\Transaction;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Products\ProductRepository;
use App\UseCases\Contracts\Transactions\CreateTransactionUseCaseInterface;
use App\UseCases\Contracts\Transactions\ValidateLimitOfTransactionsByAccountUseCaseInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreateTransactionsController extends Controller
{

    protected CreateTransactionUseCaseInterface $createTransactionUseCase;

    public function __construct(CreateTransactionUseCaseInterface $createTransactionUseCase)
    {
        $this->createTransactionUseCase = $createTransactionUseCase;
    }

    public function __invoke(CreateTransactionRequest $request)
    {
        $shopkeeper = $request->user();
        $createTransactionDTO = new CreateTransactionDTO;
        $createTransactionDTO->shopkeeper = $shopkeeper;
        $createTransactionDTO->productID = intval($request->input('productID'));
        $createTransactionDTO->accountNumber = strval($request->input('accountNumber'));
        $createTransactionDTO->amount = floatval($request->input('amount'));
        $createTransactionDTO->type = strval($request->input('type'));
        $createTransactionDTO->status = 'hold';
        $createTransactionDTO->detail = strval($request->input('detail'));
        $createTransactionDTO->date = strval($request->input('date'));
        $createTransactionDTO->ownCommission = floatval($request->input('ownCommission'));
        $createTransactionDTO->userIP = \Request::ip();

        $transactionCreationData = $this->createTransactionUseCase->handle($createTransactionDTO);

        return response()->json($transactionCreationData);
    }
}
