<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Distribuidor";
        $user->email = "distributor@gmail.com";
        $user->password = Hash::make('distributor');
        $user->role = "Distributor";
        $user->phone = "4564323";
        $user->document_type = "CC";
        $user->document = "657432";
        $user->city = "Bogota";
        $user->address = "calle 78a #92-47";
        //$user->priority = 4;
        $user->is_enabled = 1;
        //$user->balance = 400000;
        $user->save();
        $user->assignRole('Distributor');
    }
}
