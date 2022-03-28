<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Administrador";
        $user->email = "administrator@gmail.com";
        $user->password = Hash::make('administrator');
        $user->role = "Administrator";
        $user->phone = "2345432";
        $user->commission = 20;
        $user->transaction_limit = 40;
        $user->document = "23425445";
        $user->city = "Bogota";
        $user->address = "calle 58a #90-43";
        $user->priority = 4;
        $user->is_enabled = 1;
        $user->save();
    }
}
