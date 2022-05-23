<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\ReasignTransaction;

class TransactionReasign extends Command
{
    use ReasignTransaction;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:reasign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command allow us reasign transaction';

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
        $this->reasignTransaction();
    }
}
