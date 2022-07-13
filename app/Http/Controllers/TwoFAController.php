<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

/**
 * @author Kevin Andrey Herrera Silva
 */
class TwoFAController extends Controller
{
    /**
     * Manage 2FA session
     */
    public function index(): Factory|View|Application
    {
        $user = Auth::user();

        $registration_data['email'] = $user->email;
        $google2fa = app('pragmarx.google2fa');

        if ($user->qr == 0) {
            /**
             * First login, we generate new QR code
             */
            $registration_data['google2fa_secret'] = $google2fa->generateSecretKey();
            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                $registration_data['email'],
                $registration_data['google2fa_secret']
            );
            $user->google2fa_secret = $registration_data['google2fa_secret'];
            $user->qr = 1;
            $user->save();
            return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);
        }

        return redirect('/home');
    }
}
