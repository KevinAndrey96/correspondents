<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionField;

class EditFieldsTransactionsController extends Controller
{
    public function __invoke()
    {
        $transactionFields = TransactionField::first();

        return view('transactions.editFields', compact('transactionFields'));
    }
}
