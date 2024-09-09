<?php

namespace App\Repositories\Contracts\Products;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll();
    public function getByID(int $id): Product;
    public function getByUserID(int $productID, int $userID);
}
