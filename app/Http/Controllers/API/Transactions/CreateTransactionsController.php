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
    /**
     * Create Transaction
     * @OA\Schema(
     *      schema="TransactionType",
     *      type="string",
     *      enum={"Deposit","Withdrawal"}
     *  ),
     * @OA\Post (
     *     path="/api/v1/transaction/create",
     *     tags={"Transaction"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="product_id", type="integer", example=1),
     *              @OA\Property(property="account_number", type="string", example="1234567890"),
     *              @OA\Property(property="amount", type="number", format="float", example=20000.50),
     *              @OA\Property(property="type", ref="#/components/schemas/TransactionType"),
     *              @OA\Property(property="detail", type="string", example="Tipo de cuenta: Ahorros,Nit: 332435,"),
     *              @OA\Property(property="date", type="string", example="2024-09-10")
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Success Transaction Creation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                  property="transaction_id",
     *                  type="integer",
     *                  example="3111"
     *              ),
     *              @OA\Property(
     *                   property="message",
     *                   type="string",
     *                   example="Transacción asignada a proveedor"
     *              )
     *           )
     *        ),
     *     @OA\Response(
     *          response=204,
     *          description="There are no suppliers",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                   property="transaction_id",
     *                   type="integer",
     *                   example="3111"
     *               ),
     *               @OA\Property(
     *                    property="message",
     *                    type="string",
     *                    example="No hay proveedores disponibles"
     *               )
     *            )
     *         ),
     *     @OA\Response(
     *           response=429,
     *           description="Transaction limit per period exceeded",
     *           @OA\JsonContent(
     *               @OA\Property(
     *                    property="transaction_id",
     *                    type="integer",
     *                    example="3111"
     *                ),
     *                @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="Esta cuenta superó el límite de transacciones por periodo, podrá realizar transacciones con la misma a partir de las 11:06 PM"
     *                )
     *             )
     *          )
     *       )
     */

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
        $createTransactionDTO->productID = intval($request->input('product_id'));
        $createTransactionDTO->accountNumber = strval($request->input('account_number'));
        $createTransactionDTO->amount = floatval($request->input('amount'));
        $createTransactionDTO->type = strval($request->input('type'));
        $createTransactionDTO->status = 'hold';
        $createTransactionDTO->detail = strval($request->input('detail'));
        $createTransactionDTO->date = strval($request->input('date'));
        $createTransactionDTO->ownCommission = floatval($request->input('own_commission'));
        $createTransactionDTO->userIP = \Request::ip();

        $transactionCreationData = $this->createTransactionUseCase->handle($createTransactionDTO);

        return response()->json($transactionCreationData);
    }
}
