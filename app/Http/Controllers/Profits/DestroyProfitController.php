<?php

namespace App\Http\Controllers\Profits;

use App\Models\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestroyProfitController extends Controller
{
    public function destroy($profitID)
    {
        $profit = Profit::findOrFail($profitID);
        Profit::destroy($profitID);
        return redirect('profit');
    }
}
