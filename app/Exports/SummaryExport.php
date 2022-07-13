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

    public function forDateFrom(Carbon $dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function forDateTo(Carbon $dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function view(): View
    {
        if (Auth::user()->role == 'Shopkeeper' or Auth::user()->role == 'Supplier') {
            if ($this->dateFrom == $this->dateTo) {
                dd(Summary::where('user_id','=',Auth::user()->id)->whereDate('created_at', '>',$this->dateTo)->get());
                return view('balance.summaryExcelExport', [
                    'summaries' => Summary::where('user_id','=',Auth::user()->id)->whereDate('created_at', '>',$this->dateTo)->get()
                ]);
            }
            return view('balance.summaryExcelExport', [
                'summaries' => Summary::where('user_id','=',Auth::user()->id)->whereBetween('created_at',[$this->dateFrom, $this->dateTo])->get()
            ]);
        }
    }
}
