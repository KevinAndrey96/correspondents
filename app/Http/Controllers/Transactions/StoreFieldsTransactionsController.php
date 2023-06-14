<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionField;

class StoreFieldsTransactionsController extends Controller
{
    public function __invoke(Request $request)
    {
        $transactionField = TransactionField::first();

        $transactionField->document = $request->input('document');
        $transactionField->document_type = $request->input('document_type');
        $transactionField->email = $request->input('email');
        $transactionField->first_code = $request->input('first_code');
        $transactionField->second_code = $request->input('second_code');
        $transactionField->client_name = $request->input('client_name');
        $transactionField->save();

        return redirect()->route('transactions.fields');

    }
}
