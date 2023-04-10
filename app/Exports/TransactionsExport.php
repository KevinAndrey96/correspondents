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

    public function forStatus($status)
    {
        $this->status = $status;

        return $this;
    }



    public function forProductID($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function forDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function forDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function view(): View
    {   /*
        if ((Auth::user()->role == 'Administrator' ||  Auth::user()->role == 'Shopkeeper') && isset($this->product_id)) {
            if (Auth::user()->role == 'Administrator') {
                return view('transactions.excelExport', [
                    'transactions' => Transaction::where('product_id', $this->product_id)->get()
                ]);
            }

            if (Auth::user()->role == 'Shopkeeper') {

                return view('transactions.excelExport', [
                    'transactions' => Transaction::where('product_id', $this->product_id)
                                                    ->where('shopkeeper_id', Auth::user()->id)
                                                    ->whereBetween('created_at', [Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                                                    ->get()
                ]);
            }
        }
        */


        if (Auth::user()->role == 'Administrator') {
            if ($this->product_id == 'all' && $this->status == 'all') {
                return view('transactions.excelExport',
                            ['transactions' => Transaction::whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])->get()]);
            } elseif ($this->product_id != 'all' && $this->status == 'all') {
                return view('transactions.excelExport', ['transactions' => Transaction::where('product_id', $this->product_id)
                                                                                            ->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                                                                                            ->get()]);
            } elseif ($this->product_id == 'all' && $this->status != 'all') {
                return view('transactions.excelExport', ['transactions' => Transaction::where('status', 'like', $this->status)
                                                                                            ->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                                                                                            ->get()]);
            } elseif ($this->product_id != 'all' && $this->status != 'all') {
                return view('transactions.excelExport', ['transactions' => Transaction::where([
                                                                                                    ['product_id', $this->product_id],
                                                                                                    ['status', 'like', $this->status]
                                                                                            ])
                                                                                            ->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                                                                                            ->get()]);
            }
        }

        if (Auth::user()->role == 'Distributor' || Auth::user()->role == 'Supplier' || Auth::user()->role == 'Shopkeeper') {
            if ($this->product_id == 'all' && $this->status == 'all') {
                return view('transactions.excelExport',
                    ['transactions' => Transaction::where(strtolower(Auth::user()->role).'_id', Auth::user()->id)
                                                    ->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])->get()]);
            } elseif ($this->product_id != 'all' && $this->status == 'all') {
                return view('transactions.excelExport', ['transactions' => Transaction::where([
                                                                                                    [strtolower(Auth::user()->role).'_id', Auth::user()->id] ,
                                                                                                    ['product_id', $this->product_id]])
                                                                                            ->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                                                                                            ->get()]);
            } elseif ($this->product_id == 'all' && $this->status != 'all') {
                return view('transactions.excelExport', ['transactions' => Transaction::where([
                                                                                                    [strtolower(Auth::user()->role).'_id', Auth::user()->id],
                                                                                                    ['status', $this->status]])
                                                                                            ->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                                                                                            ->get()]);

            } elseif ($this->product_id != 'all' && $this->status != 'all') {
                return view('transactions.excelExport', ['transactions' => Transaction::where([
                                                                                                    [strtolower(Auth::user()->role).'_id', Auth::user()->id],
                                                                                                    ['product_id', $this->product_id],
                                                                                                    ['status', 'like', $this->status]])
                                                                                            ->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])
                                                                                            ->get()]);
            }
        }
        /*
        if (Auth::user()->role == 'Distributor') {
            return view('transactions.excelExport', [
                'transactions' => Transaction::where('distributor_id','=',Auth::user()->id)->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])->get()
            ]);
        }

        if (Auth::user()->role == 'Supplier') {
            return view('transactions.excelExport', [
                'transactions' => Transaction::where('supplier_id','=',Auth::user()->id)->whereBetween('date',[Carbon::parse($this->dateFrom), Carbon::parse($this->dateTo)])->get()
            ]);
        }
        */
    }
}
