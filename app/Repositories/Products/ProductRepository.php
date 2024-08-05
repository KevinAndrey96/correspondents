<?php

namespace App\Repositories\Products;

use App\Models\Product;
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
}
