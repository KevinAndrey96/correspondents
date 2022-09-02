<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Commission;
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
    /**
     * @throws ValidationException
     */
    public function store(Request $request): Factory|View|Redirector|RedirectResponse|Application
    {
        $fields = [
            'transactionAmount'=>'required|numeric|min:20000|max:200000',
        ];
        $message = [
            'required'=>':attribute es requerido',
        ];

        $this->validate($request, $fields, $message);

        $productID = $request->input('productID');
        $product = Product::find($productID);

        /**
         * We validate that the type present in the request is congruent with the product type
         */
        if ($product->product_type !== $request->input('transactionType')) {
            return redirect('/transactions/create')->with('insufficientBalance', 'Se ha presentado un error inesperado en la plataforma, por favor intentelo de nuevo');
        }

        if (
            $request->input('transactionType') === Transaction::TYPE_DEPOSIT
            && (double) Auth::user()->balance < (double) $request->input('transactionAmount')
        ) {
            return redirect('/transactions/create')->with('insufficientBalance', 'No tiene saldo suficiente para realizar la transacción');
        }

        $commission = Commission::where([
            ['user_id', '=', Auth::user()->id],
            ['product_id', '=', $product->id]
        ])->first();

        if (is_null($commission)) {
            return redirect('/transactions/create')->with('thereIsNotCommission', 'No tiene comisión asignada para este producto');
        }

        $transaction = new Transaction();
        $transaction->product_id = $product->id;
        $transaction->amount = $request->input('transactionAmount');
        $transaction->date = Carbon::now();
        $transaction->type = $product->product_type;
        $transaction->status = 'hold';

        return view('transactions.clientDataCreate', compact('transaction', 'product'));
    }
}
