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

        $transactionField->account = $request->input('account');
        $transactionField->phone = $request->input('phone');
        $transactionField->document = $request->input('document');
        $transactionField->code = $request->input('code');
        $transactionField->save();

        return redirect()->route('transactions.fields');

    }
}
