<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\UserTransactionLimit;
use Illuminate\Http\Request;

class DeleteTransactionLimitsUsersController extends Controller
{
    public function __invoke($id)
    {
        UserTransactionLimit::destroy($id);

        return back()->with('successTransactionLimitsDelete', 'Eliminación de límites de transacción satisfactoría');
    }
}
