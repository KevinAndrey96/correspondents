<?php

namespace App\Exports;

use App\Models\Profit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfitsExport implements FromView, ShouldAutoSize
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
        if (Auth::user()->role == 'Administrator') {
            return view('profit.excelExport', [
                'profits' => Profit::whereBetween('date',[$this->dateFrom, $this->dateTo])->get()
            ]);
        }
        if (Auth::user()->role != 'Administrator') {
            return view('profit.excelExport', [
                'profits' => Profit::where('user_id','=',Auth::user()->id)->whereBetween('date',[$this->dateFrom, $this->dateTo])->get()
            ]);
        }
    }
}
