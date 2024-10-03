<?php

namespace App\Http\Controllers\API\Transactions;

use App\Http\Controllers\Controller;
use App\UseCases\Contracts\Transactions\GetTransactionDetailUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Get transaction detail
 * @OA\Get(
 *     path="/api/v1/transaction/detail/{id}",
 *     tags={"Transaction"},
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the transaction to retrieve",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Get transaction detail",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                      type="object",
 *                      @OA\Property(property="type", type="string", example="transaction_detail"),
 *                      @OA\Property(property="attributes", type="object",
 *                          @OA\Property(property="transaction_id", type="integer", example=3817),
 *                          @OA\Property(property="transaction_status", type="string", example="cancelled"),
 *                          @OA\Property(property="account_number", type="string", example="1234567810"),
 *                          @OA\Property(property="transaction_type", type="string", example="Deposit"),
 *                          @OA\Property(property="amount", type="number", format="float", example=20000.50),
 *                          @OA\Property(property="transaction_detail", type="string", example="Tipo de cuenta: Ahorros,Nit: 332435,"),
 *                          @OA\Property(property="product_id", type="integer", example=1),
 *                          @OA\Property(property="product_name", type="string", example="BANCOLOMBIA")
 *                      )
 *                  )
 *              )
 *          ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Unauthenticated.")
 *          )
 *      )
 *   )
 */

class DetailTransactionsController extends Controller
{


    protected GetTransactionDetailUseCaseInterface $getTransactionDetailUseCase;

    public function __construct(GetTransactionDetailUseCaseInterface $getTransactionDetailUseCase)
    {
        $this->getTransactionDetailUseCase = $getTransactionDetailUseCase;
    }


    public function __invoke(int $id)
    {
        return $this->getTransactionDetailUseCase->handle($id);
    }
}
