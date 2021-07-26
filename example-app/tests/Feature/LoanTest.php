<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        $data = [
            "email" => 'devtest@gmail.com',
            "password" => "123456",
        ];
        $response = $this->postJson('/api/auth/login', $data);
        $token = $response['data']['access_token'];

        $body = [
            "loan_plan_id" => 1,
            "start_date" => "2021-08-01",
            "end_date" => "2022-08-01",
            "arrangement_fee" => 100000,
            "origin_amount" => 1000000000
        ];

        $header = [
            'Authorization' => "Bearer $token",
        ];

        $response = $this->postJson('/api/loans/create', $body, $header);

        $response->assertStatus(201);
    }
}
