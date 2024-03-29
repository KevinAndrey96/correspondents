<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\ReassignTransaction;

/**
 * To Execute in Cpanel is necessary write this command
 * /usr/local/bin/ea-php80 -d "disable_functions=" /home/corresponsal/repositories/correspondents/artisan schedule:run
 */
class TransactionReassign extends Command
{
    use ReassignTransaction;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:reassign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command allow us reassign transaction';

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
        $this->reassignTransaction();
    }
}
