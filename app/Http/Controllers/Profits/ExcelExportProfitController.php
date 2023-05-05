<?php

namespace App\Http\Controllers\Profits;

use App\Http\Controllers\Controller;
use App\Exports\ProfitsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelExportProfitController extends Controller
{
    public function export(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $dateFrom = Carbon::parse($dateFrom);
        $dateTo = Carbon::parse($dateTo);

        return (new ProfitsExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->download('Ganancias-desde-'.$dateFrom->format('d-m-Y').'-hasta-'.$dateTo->format('d-m-Y').'.xlsx');
    }
}
