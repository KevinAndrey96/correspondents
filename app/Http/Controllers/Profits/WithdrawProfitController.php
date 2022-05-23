<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request as RequestAlias;
use Carbon\Carbon;

class WithdrawProfitController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->role != 'Administrator') {
            $fields = [
                'amount'=>'required|numeric|max:'.Auth::user()->profit,
                'entity'=>'required',
                'acountNumber'=>'required',
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);

            $extra = 'Entidad: '.$request->input('entity').','.' Numero de Cuenta: '.$request->input('acountNumber');

            date_default_timezone_set('America/Bogota');
            $date = Carbon::now();
            $profit = new Profit();
            $profit->user_id = Auth::user()->id;
            $profit->amount = $request->input('amount');
            $profit->date = $date;
            $profit->type = 'Withdrawal';
            $profit->extra = $extra;
            $profit->save();
    
            return redirect('home');
        }
        if (Auth::user()->role == 'Administrator') {
            $fields = [
                'amount'=>'required|numeric|max:'.Auth::user()->profit,
            ];
            $message = [
                'required'=>':attribute es requerido',
            ];
            $this->validate($request, $fields, $message);

            $extra = 'Retiro administrador';
            $date = Carbon::now();
            $profit = new Profit();
            $profit->user_id = Auth::user()->id;
            $profit->amount = $request->input('amount');
            $profit->date = $date;
            $profit->type = 'Withdrawal';
            $profit->extra = $extra;
            $profit->is_valid = 1;
            $profit->save();
    
            return redirect('home');
        }
    }
}
