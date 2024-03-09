<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserTransactionLimit;
use Illuminate\Http\Request;

class StoreTransactionLimitsUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $fields = [
            'userID' => 'required|string',
            'productID' => 'required|string',
            'lowerLimit' => 'required|string',
            'upperLimit' => 'required|string',
        ];

        $message = [
            'required' => 'El :attribute es requerido',
        ];

        $this->validate($request, $fields, $message);

        $userID = intval($request->input('userID'));
        $productID = intval($request->input('productID'));
        $lowerLimit = floatval($request->input('lowerLimit'));
        $upperLimit = floatval($request->input('upperLimit'));

        $userTransactionLimits = UserTransactionLimit::where([
            ['user_id', $userID],
            ['product_id', $productID]
        ])
            ->first();

        if (! is_null($userTransactionLimits)) {
            $userTransactionLimits->delete();
        }

        $userTransactionLimits = new UserTransactionLimit();
        $userTransactionLimits->user_id = $userID;
        $userTransactionLimits->product_id = $productID;
        $userTransactionLimits->lower_limit = $lowerLimit;
        $userTransactionLimits->upper_limit = $upperLimit;
        $userTransactionLimits->save();

        return back()->with('successTransactionLimitsAssigment', 'Asignación de límites de transacción a tendero satisfactoría');
    }
}
