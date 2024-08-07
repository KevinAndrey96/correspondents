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
     *         description="Get enable products",
     *     )
     * )
     */

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function __invoke()
    {
        $products = $this->productRepository->getAll();

        return response(ProductsResource::collection($products));
    }
}
