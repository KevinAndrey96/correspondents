<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ApiLoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $login = $this->json('POST', 'v1/user/login', [
            "email" => "shopkeeper@gmail.com",
            "password" => "shopkeeper1234"
        ]);

        $login->assertStatus(404);
    }
}
