<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateCommissionsController extends Controller
{
    public function update(Request $request)
    {
        try {
            $j = 0;
            $ids = explode(',', $request->input('ids'));
            $amounts = explode(',', $request->input('amounts'));
            $user = User::find(Auth::user()->id);
            for ($i = 0; $i < count($ids); $i++) {
                if ($amounts[$i] != "") {
                    $commission = Commission::find($ids[$i]);
                    if (($user->role == 'Administrator') && ($commission->user->role == 'Distributor'
                            || $commission->user->role == 'Supplier')) {
                        if (floatval($commission->product->product_commission) >= floatval($amounts[$i])) {
                            $commission->amount = floatval($amounts[$i]);
                            $commission->save();
                        } else {
                            $j++;
                        }

                    }
                    if (($user->role == 'Distributor' && $commission->user->role == 'Shopkeeper') &&
                        ($user->id == $commission->user->distributor_id)) {
                        $distCommission = Commission::where('user_id', '=', Auth::user()->id)
                            ->where('product_id', '=', $commission->product_id)->first();
                        if (floatval($distCommission->amount) >= floatval($amounts[$i])) {
                            $commission->amount = floatval($amounts[$i]);
                            $commission->save();
                        } else {
                            $j++;
                        }

                    }
                }
            }
            if ($j > 0) {

                return back()->with('UpdaCommissionFailed', 'No se pudieron asignar todas la comisiones ya que algunas superan el tope máximo');
            } else {

                return back()->with('UpdaCommissionSuccess', 'Comisiones asignadas');
            }
        } catch (Exception $e){
            
            return back()->with('noCommissions', 'El distribuidor asociado aún no tiene comisiones asignadas');
        }
    }
}
