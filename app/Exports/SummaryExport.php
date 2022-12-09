<?php

namespace App\Exports;

use App\Models\Summary;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SummaryExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function forShopkeeperID($shopkeeperID)
    {
        $this->shopkeeperID = $shopkeeperID;

        return $this;
    }

    public function forDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom . ' 00:00:00';

        return $this;
    }

    public function forDateTo($dateTo)
    {
        $this->dateTo = $dateTo . ' 23:59:59';

        return $this;
    }

    public function view(): View
    {
        if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Distributor' && isset($this->shopkeeperID)) {
            $summaries = Summary::where('user_id', $this->shopkeeperID)->get();
            return view('balance.summaryExcelExport', compact('summaries'));
        }



        if (Auth::user()->role == 'Shopkeeper' or Auth::user()->role == 'Supplier') {
            if ($this->dateFrom == $this->dateTo) {
                return view('balance.summaryExcelExport', [
                    'summaries' => Summary::where('user_id', '=', Auth::user()->id)
                        ->whereDate('created_at', '>=', $this->dateTo)
                        ->whereDate('created_at', '<=', $this->dateFrom)
                        ->get()
                ]);
            }
            return view('balance.summaryExcelExport', [
                'summaries' => Summary::where('user_id', '=', Auth::user()->id)
                    ->whereBetween('created_at', [Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                    ->get()
            ]);
        }
    }
}
