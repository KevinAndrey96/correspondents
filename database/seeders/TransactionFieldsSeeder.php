<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionField;

class TransactionFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionFields = new TransactionField();
        $transactionFields->document = 'Documento:';
        $transactionFields->document_type = 'Tipo de documento:';
        $transactionFields->email = 'Correo:';
        $transactionFields->first_code = 'Código';
        $transactionFields->second_code = 'Segundo código';
        $transactionFields->client_name = 'Nombre del cliente';
        $transactionFields->save();
    }
}
