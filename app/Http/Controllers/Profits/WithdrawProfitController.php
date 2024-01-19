<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request as RequestAlias;
use Carbon\Carbon;

class WithdrawProfitController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (Auth::user()->role != 'Administrator') {

            $fields = [
                'amount' => 'required|string',
                'entity' => 'required',
                'accountNumber' => 'required',
            ];

            $message = [
                'amount.required' => 'El monto es requerido',
                'accountNumber.required' => 'La cuenta es requerida',
                'entity.required' => 'La entidad es requerida',
            ];

            $this->validate($request, $fields, $message);
        }

        if (Auth::user()->role == 'Administrator') {

            $fields = [
                'amount' => 'required|string',
            ];

            $message = [
                'amount.required' => 'El monto es requerido.',
            ];

            $this->validate($request, $fields, $message);

        }

        $amount = floatval(amountFormat($request->amount));

        if ($amount == 0 || is_null($request->amount)) {

            return back()->with('noAmount', 'Por favor ingrese un monto.');
        }

        $entity = strtoupper($request->input('entity'));
        $currentUser = User::find(Auth::user()->id);
        $ongoingProfit = Profit::where([
            ['user_id', '=', $currentUser->id],
            ['is_valid', '=', null]
        ])->first();

        if (isset($ongoingProfit)) {

            return back()->with('existingProfit', 'Tiene un retiro de ganancia en proceso');
        }

        if ($amount > $currentUser->profit) {

            return back()->with('limitExceeded', 'Por favor ingrese un monto que no sobrepase su ganancia.');
        }

        if (Auth::user()->role != 'Administrator') {
            $extra = 'Entidad: '.$entity.','.' Número de Cuenta: '.$request->input('accountNumber');

            date_default_timezone_set('America/Bogota');

            $date = Carbon::now();
            $profit = new Profit();
            $profit->user_id = Auth::user()->id;
            $profit->amount = $amount;
            $profit->date = $date;
            $profit->type = 'Withdrawal';
            $profit->extra = $extra;
            $profit->save();

            return redirect('home');
        }

        if (Auth::user()->role == 'Administrator') {
            $extra = 'Retiro administrador';
            $date = Carbon::now();
            $profit = new Profit();
            $profit->user_id = Auth::user()->id;
            $profit->amount = $amount;
            $profit->date = $date;
            $profit->type = 'Withdrawal';
            $profit->extra = $extra;
            $profit->is_valid = 1;
            $profit->save();
            $user = User::find(1);
            $user->profit -= $amount;
            $user->save();

            return redirect('home');
        }
    }
}
