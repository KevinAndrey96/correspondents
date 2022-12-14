<?php

namespace App\Http\Controllers\Balances;

use App\Http\Controllers\Controller;
use App\Exports\SummaryExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelExportSummaryController extends Controller
{
    public function export(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');

        if (isset($request->shopkeeper_id)) {
            $shopkeeper = User::find($request->input('shopkeeper_id'));
            return (new SummaryExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->forShopkeeperID($shopkeeper->id)->download('Extracto de '.$shopkeeper->name.'.xlsx');
        }

        return (new SummaryExport)->forDateFrom($dateFrom)->forDateTo($dateTo)->download('Extracto-desde-'.$dateFrom.'-hasta-'.$dateTo.'.xlsx');
    }
}
