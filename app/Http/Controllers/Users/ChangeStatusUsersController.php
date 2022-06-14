<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Mail;

class ChangeStatusUsersController extends Controller
{
    public function changeStatus(Request $request)
    {
        //return $request;
        $user = User::find($request->input('id'));
        $user->is_enabled = $request->input('status');
        $user->save();

        $receiverEmail = $user->email;
        $emailBody = new \stdClass();
        $emailBody->sender = 'Asparecargas';
        $emailBody->receiver = $user->name;
        if($user->is_enabled == 1 ){
            $emailSubject = 'Su usuario fue desbloqueado';
            $emailBody->body = 'Su cuenta fue desbloqueada.';
        }else{
            $emailSubject = 'Su usuario fue bloqueado';
            $emailBody->body = 'Su cuenta ha sido suspendida.';
        }
        Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));

        return back();
    }
}
