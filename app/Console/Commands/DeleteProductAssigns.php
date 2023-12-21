<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\SupplierProduct;

class DeleteProductAssigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('role', 'Distributor')
            ->orWhere('role', 'Shopkeeper')
            ->get();

        foreach ($users as $user) {
            $userProducts = SupplierProduct::where('user_id', $user->id)->get();

            foreach ($userProducts as $userProduct) {
                $userProduct->delete();
            }
        }
    }
}
