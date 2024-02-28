<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexGroupsCommissionsController extends Controller
{
    public function __invoke()
    {
        $commissionsGroups = CommissionsGroup::where('user_id', Auth::user()->id)->get();

        //Get all registers of table commissions_group_general_commissions with eager loading
        $commissionsGroupGeneralCommissions = CommissionsGroupGeneralCommission::with('commissionGroup', 'generalCommission')->get();

        return view('commissions.groups', ['commissionsGroups' => $commissionsGroups, 'commissionsGroupGeneralCommissions' => $commissionsGroupGeneralCommissions]);
    }
}
