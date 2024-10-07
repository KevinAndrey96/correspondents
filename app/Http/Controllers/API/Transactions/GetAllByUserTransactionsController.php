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
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Get all transactions by user
 * @OA\Get(
 *     path="/api/v1/transactions/user",
 *     tags={"Transaction"},
 *      @OA\Response(
 *          response=200,
 *          description="Get all transactions by user",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      type="object",
 *                      @OA\Property(property="type", type="string", example="transaction"),
 *                      @OA\Property(property="attributes", type="object",
*                           @OA\Property(property="id", type="integer", example=3821),
*                           @OA\Property(property="account_number", type="string", example="1234567890"),
*                           @OA\Property(property="amount", type="number", format="float", example=20000.5),
*                           @OA\Property(property="type", type="string", example="Deposit"),
*                           @OA\Property(property="status", type="string", example="cancelled"),
*                           @OA\Property(property="detail", type="string", example="Tipo de cuenta: Ahorros,Nit: 332435,"),
*                           @OA\Property(property="date", type="string", format="date", example="2024-09-10"),
*                           @OA\Property(property="voucher", type="string", nullable=true, example=null),
*                           @OA\Property(property="comment", type="string", nullable=true, example=null),
*                           @OA\Property(property="observation", type="string", nullable=true, example=null),
*                           @OA\Property(property="created_at", type="string", example="2024-09-29T22:30:13.000000Z"),
*                           @OA\Property(property="updated_at", type="string", example="2024-09-29T22:30:13.000000Z")
 *                      )
 *                  )
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Unauthenticated.")
 *          )
 *      )
 *   )
 */


class GetAllByUserTransactionsController extends Controller
{
    protected GetAllTransactionsByUserUseCaseInterface $getAllTransactionsByUserUseCase;

    public function __construct(GetAllTransactionsByUserUseCaseInterface $getAllTransactionsByUserUseCase)
    {
        $this->getAllTransactionsByUserUseCase = $getAllTransactionsByUserUseCase;
    }
    public function __invoke(Request $request)
    {
        $userID = $request->user()->id;
        return $this->getAllTransactionsByUserUseCase->handle($userID);
    }
}
