<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Balance;
use App\Models\Profit;
use App\Models\Transaction;
use App\Models\Summary;
use App\Models\User;

class MoneyTablesTruncate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moneyTables:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command truncates all tables related to money';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Balance::truncate();
        Transaction::truncate();
        Profit::truncate();
        Summary::truncate();

        $users = User::all();

        foreach($users as $user) {
            $user->balance = 0;
            $user->save();
        }
    }
}
