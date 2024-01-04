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

        if ($user->qr_enabled == 0) {
            $provider = 'Asparecargas';

            if (isset($user->brand_id)) {
                $provider = $user->brand->domain;
            }

            $emailBody->body = 'Yo, '.$user->name.', declaro que he decidido deshabilitar voluntariamente el sistema de
            seguridad QR que me ofrecía el proveedor '.$provider.'. Reconozco que este sistema de seguridad QR me
            brindaba una mayor protección contra el fraude, el robo de identidad y otras amenazas cibernéticas.
            Al deshabilitar este sistema de seguridad QR, asumo la responsabilidad de cualquier daño o pérdida que pueda
            sufrir como consecuencia de esta decisión. También libero al proveedor de cualquier responsabilidad civil, penal
            o administrativa que pueda derivarse de mi deshabilitación del sistema de seguridad QR.';

            Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));
        }

        if ($user->role == 'Distributor' || $user->role == 'Administrator' || $user->role == 'Supplier') {

           return redirect('/users?role='.$user->role);
        }

      return redirect('/users?role=allShopkeepers');
    }
}
