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
     *                     @OA\Property(property="type", type="string", example="products"),
     *                     @OA\Property(property="attributes", type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="product_name", type="string", example="BANCOLOMBIA"),
     *                         @OA\Property(property="product_description", type="string", example="<p>DEPOSITO BANCOLOMBIA</p>"),
     *                         @OA\Property(property="product_logo", type="string", example="/storage/products/1.png"),
     *                         @OA\Property(property="product_commission", type="integer", example=800),
     *                         @OA\Property(property="client_name", type="integer", example=0),
     *                         @OA\Property(property="client_document", type="integer", example=0),
     *                         @OA\Property(property="phone_number", type="integer", example=0),
     *                         @OA\Property(property="email", type="integer", example=0),
     *                         @OA\Property(property="account_type", type="integer", example=1),
     *                         @OA\Property(property="account_number", type="integer", example=1),
     *                         @OA\Property(property="code", type="integer", example=0),
     *                         @OA\Property(property="extra", type="integer", example=0),
     *                         @OA\Property(property="min_amount", type="integer", example=5000),
     *                         @OA\Property(property="max_amount", type="integer", example=300000),
     *                         @OA\Property(property="priority", type="integer", example=1),
     *                         @OA\Property(property="num_jineteo", type="integer", example=3),
     *                         @OA\Property(property="hours", type="integer", example=1),
     *                         @OA\Property(property="reassignment_minutes", type="integer", example=2),
     *                         @OA\Property(property="com_dis", type="null"),
     *                         @OA\Property(property="com_shp", type="null"),
     *                         @OA\Property(property="com_sup", type="null"),
     *                         @OA\Property(property="fixed_commission", type="number", example=200),
     *                         @OA\Property(property="giros", type="integer", example=0),
     *                         @OA\Property(property="are_default_fields", type="integer", example=1),
     *                         @OA\Property(property="field_names", type="null"),
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
