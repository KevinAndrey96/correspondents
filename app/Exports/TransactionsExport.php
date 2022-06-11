<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionsExport implements FromView, ShouldAutoSize
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
            return view('transactions.excelExport', [
                'transactions' => Transaction::whereBetween('date',[$this->dateFrom, $this->dateTo])->get()
            ]);
        }
        if (Auth::user()->role == 'Shopkeeper') {
            return view('transactions.excelExport', [
                'transactions' => Transaction::where('shopkeeper_id','=',Auth::user()->id)->whereBetween('date',[$this->dateFrom, $this->dateTo])->get()
            ]);
        }
        if (Auth::user()->role == 'Distributor') {
            return view('transactions.excelExport', [
                'transactions' => Transaction::where('distributor_id','=',Auth::user()->id)->whereBetween('date',[$this->dateFrom, $this->dateTo])->get()
            ]);
        }
        if (Auth::user()->role == 'Supplier') {
            return view('transactions.excelExport', [
                'transactions' => Transaction::where('supplier_id','=',Auth::user()->id)->whereBetween('date',[$this->dateFrom, $this->dateTo])->get()
            ]);
        }
    }
}
