<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use App\Exports\BalancesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelExportBalanceController extends Controller
{
    public function export(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $dateFrom = Carbon::parse($dateFrom);
        $dateTo = Carbon::parse($dateTo);

        return (new BalancesExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->download('Saldos-desde-'.$dateFrom->format('d-m-Y').'-hasta-'.$dateTo->format('d-m-Y').'.xlsx');
    }
}
