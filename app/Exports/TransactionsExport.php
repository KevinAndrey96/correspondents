<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function forYear(int $year)
    {
        $this->year = $year;
        
        return $this;
    }

    public function forMonth(int $month)
    {
        $this->month = $month;
        
        return $this;
    }

    public function view(): View
    {
        return view('transactions.excelExport', [
            'transactions' => Transaction::whereYear('date','=', $this->year)->whereMonth('date','=', $this->month)->get()
        ]);
    }
}
