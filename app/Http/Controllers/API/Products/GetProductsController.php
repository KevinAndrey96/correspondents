<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\ResidentResource;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use Illuminate\Http\Request;

class GetProductsController extends Controller
{
    /**
     * Get enabled products
     * @OA\Get(
     *     path="/api/v1/products",
     *     tags={"Products"},
     *     @OA\Response(
     *         response=200,
     *         description="Get enabled products",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="type", type="string", example="product"),
     *                     @OA\Property(property="attributes", type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="productName", type="string", example="BANCOLOMBIA"),
     *                         @OA\Property(property="productDescription", type="string", example="<p>DEPOSITO BANCOLOMBIA</p>"),
     *                         @OA\Property(property="productLogo", type="string", example="https://example.com/storage/products/1.png"),
     *                         @OA\Property(property="productCommission", type="integer", example=800),
     *                         @OA\Property(property="producType", type="string", example="Deposit"),
     *                         @OA\Property(property="clientName", type="integer", example=0),
     *                         @OA\Property(property="clientDocument", type="integer", example=0),
     *                         @OA\Property(property="phoneNumber", type="integer", example=0),
     *                         @OA\Property(property="email", type="integer", example=0),
     *                         @OA\Property(property="accountType", type="integer", example=1),
     *                         @OA\Property(property="accountNumber", type="integer", example=1),
     *                         @OA\Property(property="code", type="integer", example=0),
     *                         @OA\Property(property="extra", type="integer", example=0),
     *                         @OA\Property(property="areDefaultFields", type="integer", example=1),
     *                         @OA\Property(property="fieldNames", type="string", example="Número de seguro,Número de NIT,Número de registro civil"),
     *                         @OA\Property(property="minAmount", type="integer", example=5000),
     *                         @OA\Property(property="maxAmount", type="integer", example=300000),
     *                         @OA\Property(property="category", type="string", example="bancos")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     security={
     *         {"passport": {}}
     *     }
     * )
     */

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke()
    {
        $products = ProductsResource::collection($this->productRepository->getAll());

        return response()->json([
            'data' => $products
            ], 200);
    }
}
