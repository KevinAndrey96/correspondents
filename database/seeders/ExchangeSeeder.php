<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exchange;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchange = new Exchange();
        $exchange->badge = 'Pesos colombianos';
        $exchange->value = 4000;
        $exchange->save();
    }
}
