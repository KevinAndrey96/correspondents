<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBank;
use App\Models\ShopkeeperAdviser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\NoReplyMailable;
use Illuminate\Support\Facades\Mail;
use stdClass;

class StoreUsersController extends Controller
{
    public function store(Request $request)
    {
        $fields = [
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'phone'=>'required',
            'document'=>'required',
            'city'=>'required',
            'address'=>'required',
            'password'=>'required',
        ];

        if ($request->role == 'Advisers') {
            $fields = [
                'name'=>'required',
                'email'=>'required|unique:users,email',
                'phone'=>'required',
                'document'=>'required',
                'city'=>'required',
                'address'=>'required',
                ];
        }

        $message = [
            'name.required'=>'El nombre es requerido',
            'email.required'=>'El email es requerido',
            'phone.required'=>'El teléfono es requerido',
            'document.required'=>'El # de documento es requerido',
            'city.required'=>'La ciudad es requerida',
            'address.required'=>'La dirección es requerida',
            'password.required'=>'La contraseña es requerida',
            'unique'=>'El :attribute debe ser unico',
        ];

        if ($request->input('role') == 'Supplier') {
            $fields2 = [
                'priority'=>'required',
                'max_queue'=>'required',
            ];
            $fields = $fields + $fields2;
            $message2 = [
                'priority.required'=>'La prioridad es requerida',
                'max_queue.required'=>'El valor de cola maximo es requerido',
            ];
            $message = $message + $message2;
        }
        $this->validate($request, $fields, $message);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->phone =  $request->input('phone');
        $user->document_type = $request->input('document_type');
        $user->document = $request->input('document');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->is_enabled = 1;



        if ($request->input('role') == 'Supplier') {
            $user->priority = $request->input('priority');
            $user->max_queue = $request->input('max_queue');
            if (isset($request->giros)) {
                $user->giros = $request->input('giros');
            }
        }

        if (Auth::user()->role == 'Distributor') {
            $user->distributor_id = Auth::user()->id;
            $user->brand_id = Auth::user()->brand_id;
        }

        if (isset($request->password)) {
            if (strlen($request->password) < 7 || !preg_match('`[0-9]`', $request->password)
                || !preg_match('`[a-z]`', $request->password)) {

                return back()->with('unfulfilledRequirements', 'La contraseña debe tener mínimo 7 caracteres, al menos una letra y al menos un número.');
            }

            $user->password = Hash::make($request->input('password'));
        } else {
            $user->password =  Hash::make($request->input('adviser'));
        }
        $user->save();

        if ($user->role == 'Distributor') {
            if (isset($request->brand)) {
                $user->brand_id = intval($request->input('brand'));
                $user->save();
            }
        }


        if (isset($request->card_ids)) {
            foreach ($request->card_ids as $id) {
                $userBank = new UserBank();
                $userBank->user_id = $user->id;
                $userBank->card_id = intval($id);
                $userBank->save();
            }
        }

        if ($user->role == 'Shopkeeper' && $request->adviserID != 'none') {
            $shopkeeperAdviser = new ShopkeeperAdviser();
            $shopkeeperAdviser->shopkeeper_id = $user->id;
            $shopkeeperAdviser->adviser_id = intval($request->input('adviserID'));
            $shopkeeperAdviser->save();
        }

        if ($request->input('role') == 'Administrator') {
            $user->assignRole('Administrator');
        }

        if ($request->input('role') == 'Shopkeeper') {
            $user->assignRole('Shopkeeper');
        }

        if ($request->input('role') == 'Distributor') {
            $user->assignRole('Distributor');
        }

        if ($request->input('role') == 'Supplier') {
            $user->assignRole('Supplier');
        }
        $receiverEmail = $user->email;
        $emailBody = new stdClass();
        $emailBody->sender = 'Asparecargas';

        if (! is_null($user->brand_id)) {
            $emailBody->sender = $user->brand->domain;
            $emailBody->userBrandDomain = $user->brand->domain;
        }

        $emailBody->receiver = $user->name;
        $emailSubject = 'Su cuenta fue creada';
        $emailBody->body = 'Bienvenido a la plataforma, le confirmamos que se ha
        activado su cuenta exitosamente en nuestra plataforma.';
        Mail::to($receiverEmail)->send(new NoReplyMailable($emailBody, $emailSubject));

        return redirect('/users?role='.$user->role);
    }
}
