<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\SupplierProduct;


class DistributorProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $distributors = User::where('role', 'Distributor')->get();
        $products = Product::where('is_enabled', 1)->get();

        foreach ($distributors as $distributor) {
            $shopkeepers = User::where('distributor_id', $distributor->id)->get();
            $distributorProducts = SupplierProduct::where('user_id', $distributor->id)->get();

            if ($distributorProducts->count() == 0) {
                foreach ($products as $product) {
                    $distributorProduct = new SupplierProduct();
                    $distributorProduct->user_id = $distributor->id;
                    $distributorProduct->product_id = $product->id;
                    $distributorProduct->save();

                    foreach ($shopkeepers as $shopkeeper) {
                        $shopkeeperProduct = new SupplierProduct();
                        $shopkeeperProduct->user_id = $shopkeeper->id;
                        $shopkeeperProduct->product_id = $product->id;
                        $shopkeeperProduct->save();
                    }
                }
            }
        }

    }
}
