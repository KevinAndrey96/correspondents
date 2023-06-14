<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FAQRCode\Google2FA;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function run(): void
    {
        /*
        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'administrator@gmail.com';
        $user->password = Hash::make('administrator');
        $user->role = 'Administrator';
        $user->phone = '2345432';
        $user->document_type = 'CC';
        $user->document = '23425445';
        $user->city = 'Bogota';
        $user->address = 'calle 58a #90-43';
        $user->is_enabled = 1;
        $user->google2fa_secret = (new Google2FA)->generateSecretKey();
        $user->balance = 0;
        $user->save();
        $user->assignRole('Administrator');
    */
    }

}
