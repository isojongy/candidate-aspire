<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $data = [
            "email" => 'devtest@gmail.com',
            "password" => "123456",
        ];
        $response = $this->postJson('/api/auth/login', $data);
        $token = $response['data']['access_token'];

        $data = [
            "loan_id" => 29,
            "amount" => 100000,
            "content" => 'pay 100000'
        ];

        $header = [
            'Authorization' => "Bearer $token",
        ];

        $response = $this->postJson('/api/payments/create', $data, $header);

        $response->assertStatus(201);
    }
}
