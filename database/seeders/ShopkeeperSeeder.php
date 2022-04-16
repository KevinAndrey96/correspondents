<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ShopkeeperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Shopkeeper";
        $user->email = "shopkeeper@gmail.com";
        $user->password = Hash::make('shopkeeper');
        $user->role = "Shopkeeper";
        $user->phone = "6527645";
        $user->document_type = "CC";
        $user->document = "74427643";
        $user->city = "Bogota";
        $user->address = "calle 32f #72-91";
        //$user->priority = 4;
        $user->is_enabled = 1;
        $user->balance = 400000;
        $user->distributor_id = 2;
        $user->save();
        $user->assignRole('Shopkeeper');
    }
}
