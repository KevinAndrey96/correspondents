<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\NoReplyMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;

class EnableQRUsersController extends Controller
{
    public function __invoke(Request $request)
    {
       $user = User::find($request->input('id'));
       $user->qr_enabled = $request->input('enabledQR');
       $user->save();

        $receiverEmail = $user->email;
        $emailBody = new stdClass();
        $emailBody->sender = 'Asparecargas';

        if (! is_null($user->brand_id)) {
            $emailBody->sender = $user->brand->domain;
            $emailBody->userBrandDomain = $user->brand->domain;
        }

        $emailBody->receiver = $user->name;
        $emailSubject = 'Validación QR';
        $emailBody->body = 'Queremos informarle que la validación por QR ha sido desactivada para su usuario en la
        plataforma.';

        if ($user->qr_enabled == 1) {
            $emailBody->body = 'Queremos informarle que la validación por QR ha sido activada para su usuario en
            la plataforma.';
        }

        Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));

        if ($user->role == 'Distributor' || $user->role == 'Administrator' || $user->role == 'Supplier') {

           return redirect('/users?role='.$user->role);
        }

      return redirect('/users?role=allShopkeepers');
    }
}
