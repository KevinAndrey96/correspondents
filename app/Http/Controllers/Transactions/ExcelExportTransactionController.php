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
        if (isset($request->product_id)) {
            $dateFrom = $request->input('dateFrom');
            $dateTo = $request->input('dateTo');
            $product = Product::find($request->input('product_id'));
            return (new TransactionsExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->forProductID($product->id)->download('Transacciones de '.$product->product_name.'.xlsx');
        }

        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $dateFrom = Carbon::parse($dateFrom);
        $dateTo = Carbon::parse($dateTo);
        return (new TransactionsExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->download('Transacciones-desde-'.$dateFrom->format('d-m-Y').'-hasta-'.$dateTo->format('d-m-Y').'.xlsx');
    }
}
