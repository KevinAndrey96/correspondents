<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupplierInactivity;
use stdClass;

class SupplierInactivityMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:supplier-inactivity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        date_default_timezone_set('America/Bogota');
        $currentDate = Carbon::now();
        $inactiveSuppliers = collect([]);
        $suppliers = User::where('role', 'Supplier')
                         ->WhereNotNull('last_login')
                         ->get();


        foreach ($suppliers as $supplier) {
            $last_login = Carbon::parse($supplier->last_login);
            $inactivityDays = $last_login->diffInHours($currentDate);

            if ($inactivityDays >= 7)
            {
                $inactiveSuppliers->push($supplier);
            }

            if ($inactiveSuppliers->count() > 0) {
                $admins = User::where('role', 'Administrator')->get();

                foreach ($admins as $admin) {
                    $receiverEmail = $admin->email;
                    $emailBody = new stdClass();
                    $emailBody->sender = 'Asparecargas';
                    $emailBody->receiver = $admin->name;
                    $emailSubject = 'Proveedores inactivos';
                    $emailBody->body = 'Los siguientes proveedores llevan más de una semana sin realizar transacciones: ';
                    Mail::to($receiverEmail)->send(new SupplierInactivity($emailBody, $emailSubject, $inactiveSuppliers));
                }




            }




        }

        //return print_r($last_login);


    }
}
