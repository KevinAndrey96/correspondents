<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Mail;

class NoReplyEmailController extends Controller
{
    public function mailer ()
    {
        $receiverEmail = 'mjmartinezv28@gmail.com';

        $objBody = new \stdClass();
        $objBody->body_one = 'one';
        $objBody->body_two = 'two';
        $objBody->sender = 'Asparecargas';
        $objBody->receiver = 'test';

        $subject = 'test email';

        $correo = new NoReplyMailable($objBody, $subject);
        Mail::to($receiverEmail)->send($correo);
    }
}
