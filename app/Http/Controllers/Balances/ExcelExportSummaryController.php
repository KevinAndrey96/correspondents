<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use App\Exports\SummaryExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelExportSummaryController extends Controller
{
    public function export(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        //$dateFrom = Carbon::parse($dateFrom);
        //$dateTo = Carbon::parse($dateTo);
        //return (new SummaryExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->download('Extracto-desde-'.$dateFrom->format('d-m-Y').'-hasta-'.$dateTo->format('d-m-Y').'.xlsx');
        return (new SummaryExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->download('Extracto-desde-'.$dateFrom.'-hasta-'.$dateTo.'.xlsx');
    }
}
