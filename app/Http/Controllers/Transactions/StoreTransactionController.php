<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Commission;
use App\Models\TransactionField;
use App\Models\UserTransactionLimit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class StoreTransactionController extends Controller
{
    public function store(Request $request)
    {
        $fields = [
            'transactionAmount'=> 'required|string',
            'transactionType'=> 'required|string',
            "productID" => 'required|string'
        ];

        $message = [
            'transactionAmount.required' => 'El monto de la transacción es requerido',
            'transactionType.required' => 'El tipo de la transacción es requerido',
            'productID.required' => 'El id del producto es requerido'
        ];

        $this->validate($request, $fields, $message);

        $productID = $request->input('productID');
        $product = Product::find($productID);
        $amount = floatval(amountFormat($request->transactionAmount));
        $minAmount = floatval($product->min_amount);
        $maxAmount = floatval($product->max_amount);

        $giros = $request->input('giros');

        $userTransactionLimits = UserTransactionLimit::where([
            ['user_id', Auth::user()->id],
            ['product_id', $productID]
        ])->first();

        if (isset($userTransactionLimits)) {
            $minAmount = $userTransactionLimits->lower_limit;
            $maxAmount = $userTransactionLimits->upper_limit;
        }

        if ($amount == 0 || is_null($request->transactionAmount)) {

            return back()->with('noAmount', 'Por favor ingrese un monto.');
        }

        if ($amount < $minAmount || $amount > $maxAmount) {
            if (getenv('COUNTRY_NAME') == 'ECUADOR' && $giros == 1) {
                return redirect('/giros/create?giros=1')
                    ->with('limitExceeded', 'Supero el límite del monto permitido por transacción para el producto seleccionado,
                        el monto mínimo debe ser de $' . number_format(strval($minAmount), 2, ',', '.') . ' y el monto máximo de $' . number_format(strval($maxAmount), 2, ',', '.'));
            } else {
                return redirect('/transactions/create')
                    ->with('limitExceeded', 'Supero el límite del monto permitido por transacción para el producto seleccionado,
                        el monto mínimo debe ser de $' . number_format(strval($minAmount), 2, ',', '.') . ' y el monto máximo de $' . number_format(strval($maxAmount), 2, ',', '.'));
            }
        }

        /**
         * We validate that the type present in the request is congruent with the product type
         */
        if ($product->product_type !== $request->input('transactionType')) {
            if (getenv('COUNTRY_NAME') == 'ECUADOR' && $giros == 1) {
                return redirect('/giros/create?giros=1')->with('insufficientBalance', 'Se ha presentado un error inesperado en la plataforma, por favor intentelo de nuevo');
            } else {
                return redirect('/transactions/create')->with('insufficientBalance', 'Se ha presentado un error inesperado en la plataforma, por favor intentelo de nuevo');
            }
        }

        if ($request->transactionType == Transaction::TYPE_DEPOSIT && floatval(Auth::user()->balance) < $amount) {
            if (getenv('COUNTRY_NAME') == 'ECUADOR' && $giros == 1) {
                return redirect('/giros/create?giros=1')->with('insufficientBalance', 'No tiene saldo suficiente para realizar el giro');
            } else {
                return redirect('/transactions/create')->with('insufficientBalance', 'No tiene saldo suficiente para realizar la transacción');
            }
        }

        if ($giros != 1) {
            $commission = Commission::where([
                ['user_id', '=', Auth::user()->id],
                ['product_id', '=', $product->id]
            ])->first();

            if (is_null($commission)) {
                return redirect('/transactions/create')->with('thereIsNotCommission', 'No tiene comisión asignada para este producto');
            }
        }

        $transactionFields = TransactionField::first();
        $transaction = new Transaction();
        $transaction->product_id = $product->id;
        $transaction->amount = $amount;
        $transaction->date = Carbon::now();
        $transaction->type = $product->product_type;
        $transaction->status = 'hold';

        if ($transaction->product->are_default_fields)
        {

            return view('transactions.clientDataCreate', compact('transaction', 'product', 'giros', 'transactionFields', 'userTransactionLimits'));
        }

        $fieldNames = explode(',', $transaction->product->field_names);

        return view('transactions.clientDataCreate', compact('transaction', 'product', 'giros', 'transactionFields', 'fieldNames', 'userTransactionLimits'));
    }
}
