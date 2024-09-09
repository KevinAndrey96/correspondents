<?php

namespace App\Repositories\Products;

use App\Models\Product;
use App\Models\SupplierProduct;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::where([
            ['is_deleted', 0],
            ['is_enabled', 1],
        ])->get();

    }

    public function getByID(int $id): Product
    {
        return Product::find($id);
    }

    public function getByUserID(int $productID, int $userID)
    {
        return SupplierProduct::where([
            ['user_id', $userID],
            ['product_id', $productID]
        ])->get();
    }
}
