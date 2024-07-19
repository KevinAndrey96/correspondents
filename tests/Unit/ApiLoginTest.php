<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use \RonasIT\Support\AutoDoc\Tests\AutoDocTestCaseTrait;


class ApiLoginTest extends TestCase
{
    private const API_LOGIN_URL = 'api/v1/user/login';

    /**
     * A basic unit test example.
     *
     * @return void
     */
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

    public function testInvalidCredentials(): void
    {
        //ARRANGE
        $email = 'shopkeeper@gmail.com';
        $password = 'shopkeeper12345';

        //ACT
        $this->withoutExceptionHandling();
        $login = $this->json(Request::METHOD_POST, self::API_LOGIN_URL, [
            "email" => $email,
            "password" => $password
        ]);

        //ASSERT
        $login->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'message' => 'Invalid Credentials'
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }
/*
->assertExactJson([
                'errors' => [
                    [
                        'status' => (string) GeneralErrorResponse::CODE_BUSINESS_ERROR,
                        'title'  => CampaignsErrorResponse::TITLE_ERROR,
                        'detail' => CampaignNotFoundException::CAMPAIGN_VALID_NOT_FOUND,
                        'code'   => CampaignNotFoundException::CODE_CAMPAIGN_VALID_NOT_FOUND,
                        'id'     => CampaignNotFoundException::ID_CAMPAIGN_VALID_NOT
*/

}
