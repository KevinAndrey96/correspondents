<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignGroupCommissionsController extends Controller
{
    public function __invoke($userID)
    {
        $commissionsGroups = CommissionsGroup::where('user_id', Auth::user()->id)->get();
        $commissionsGroupGeneralCommissions = CommissionsGroupGeneralCommission::get();

        return view('commissions.assignGroup',  ['commissionsGroups' => $commissionsGroups,
            'commissionsGroupGeneralCommissions' => $commissionsGroupGeneralCommissions,
            'userID' => $userID]);
    }
}
