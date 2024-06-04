<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_it_can_return_token_successfully(): void
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => 's.paolo',
            'password' => 'S4b4l3t4!',
        ]);

        $response->assertStatus(200);

        $rjson = $response->json();
        $this->assertArrayHasKey('token', $rjson['data']);
        $this->assertArrayHasKey('minutes_to_expire', $rjson['data']);
    }

    public function test_it_can_logout_successfully(): void
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => 's.paolo',
            'password' => 'S4b4l3t4!',
        ]);

        $response->assertStatus(200);

        $rjson = $response->json();

        $token = $rjson['data']['token'];

        $response_logout = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->postJson(route('auth.logout'));

        $response_logout->assertStatus(200);
        $response_logout->assertExactJson([
            'meta' => [
                'success' => true,
                'error' => [],
            ],
            'data' => [
                'message' => 'Successfully logged out',
            ],
        ]);
    }

    public function test_it_can_refresh_token_successfully(): void
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => 's.paolo',
            'password' => 'S4b4l3t4!',
        ]);

        $response->assertStatus(200);

        $rjson = $response->json();

        $token = $rjson['data']['token'];

        $response_logout = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->postJson(route('auth.refresh_token'));

        $response_logout->assertStatus(200);
        $rjson2 = $response_logout->json();
        $this->assertNotEquals($rjson2['data']['token'], $token);
    }
}
