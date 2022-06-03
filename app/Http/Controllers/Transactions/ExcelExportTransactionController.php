<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Exports\TransactionsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelExportTransactionController extends Controller
{
    public function export(Request $request)
    {
        $date = $request->input('date');
        $date = Carbon::parse($date);
        $year = $date->year;
        $month = $date->month;
        return (new TransactionsExport)->forYear($year)->forMonth($month)->download('transactions.xlsx');
    }
}
