<?php

namespace App\Http\Controllers\Transactions;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Exports\TransactionsExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelExportTransactionController extends Controller
{
    public function export(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $status = $request->input('status');
        $productID = $request->input('product_id');
        if ($productID != 'all') {
            $product = Product::find($request->input('product_id'));
            return (new TransactionsExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->forProductID($productID)->forStatus($status)->download('Transacciones de '.$product->product_name.'.xlsx');
        }
            return (new TransactionsExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->forProductID($productID)->forStatus($status)->download('Transacciones.xlsx');



        /*
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $dateFrom = Carbon::parse($dateFrom);
        $dateTo = Carbon::parse($dateTo);
        return (new TransactionsExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->download('Transacciones-desde-'.$dateFrom->format('d-m-Y').'-hasta-'.$dateTo->format('d-m-Y').'.xlsx');
        */
        }
}
