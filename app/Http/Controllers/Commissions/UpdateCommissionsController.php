<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateCommissionsController extends Controller
{
    public function update(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        $amounts = explode(',', $request->input('amounts'));
        for ($i=0; $i<count($ids); $i++) {
            if ($amounts[$i] != "") {
                if (Auth::user()->role == 'Administrator') {
                    $commission =  Commission::find($ids[$i]);
                    $commission->amount = $amounts[$i];
                    $commission->save();
                }
                if (Auth::user()->role == 'Distributor') {

                    $commission =  Commission::find($ids[$i]);
                    $distCommission = Commission::where('user_id', '=', Auth::user()->id)
                                                ->where('product_id', '=', $commission->product_id)->first();
                    if (floatval($distCommission->amount) >= floatval($amounts[$i])) {
                        $commission->amount = $amounts[$i];
                        $commission->save();
                    }
                }
            }
        }

        return back()->with('UpdaCommissionSuccess', 'Comisiones actualizadas');
    }
}
