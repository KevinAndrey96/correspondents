<?php

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Controller;
use App\Models\CommissionsGroup;
use App\Models\CommissionsGroupGeneralCommission;
use Illuminate\Http\Request;

class AssignGroupCommissionsController extends Controller
{
    public function __invoke($userID)
    {
        $commissionsGroups = CommissionsGroup::get();
        $commissionsGroupGeneralCommissions = CommissionsGroupGeneralCommission::get();

        return view('commissions.assignGroup',  ['commissionsGroups' => $commissionsGroups,
            'commissionsGroupGeneralCommissions' => $commissionsGroupGeneralCommissions,
            'userID' => $userID]);
    }
}
