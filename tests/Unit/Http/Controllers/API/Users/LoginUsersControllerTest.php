<?php

namespace Http\Controllers\API\Users;

use App\Http\Controllers\API\Users\LoginUsersController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
class LoginUsersControllerTest extends TestCase
{
    private const API_LOGIN_URL = 'api/v1/user/login';
    public function testSuccess(): void
    {
        //ARRANGE
        $email = 'shopkeeper@gmail.com';
        $password = 'shopkeeper1234';

        //ACT
        $this->withoutExceptionHandling();
        $login = $this->json(Request::METHOD_POST, self::API_LOGIN_URL, [
            'email' => $email,
            'password' => $password
        ]);

        //ASSERT
        $login->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'Success Login'
            ])
            ->assertJsonStructure([
                'access_token',
                'message'
            ]);
    }
}
