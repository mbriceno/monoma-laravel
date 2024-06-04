<?php

namespace Tests\Feature;

use Tests\TestCase;

class CandidateTest extends TestCase
{
    protected function getToken()
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => 's.paolo',
            'password' => 'S4b4l3t4!',
        ]);

        return $response->json()['data']['token'];
    }

    public function test_it_can_create_candidates_successfully(): void
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->postJson(route('candidate.store'), [
            'name' => 'Michael Chandler',
            'source' => 'Twitter',
            'owner' => 2,
        ]);

        $response->assertStatus(200);
        $rjson = $response->json()['data'];
        $this->assertEquals($rjson['name'], 'Michael Chandler');
        $this->assertEquals($rjson['source'], 'Twitter');
        $this->assertEquals($rjson['owner'], 2);
    }

    public function test_it_can_get_all_candidates_successfully(): void
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->getJson(route('candidate.list'));

        $response->assertStatus(200);
        $rjson = $response->json()['data'];
        $this->assertEquals(count($rjson), 3);
    }

    public function test_it_can_get_all_candidates_owned_successfully(): void
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => 'p.dario',
            'password' => 'S4b4l3t4#',
        ]);

        $token = $response->json()['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->getJson(route('candidate.list'));

        $response->assertStatus(200);
        $rjson = $response->json()['data'];
        $this->assertEquals(count($rjson), 2);
    }

    public function test_it_can_get_candidate_by_id_successfully(): void
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->getJson(route('candidate.show', ['id' => 1]));

        $response->assertStatus(200);

        $rjson = $response->json()['data'];
        $this->assertEquals($rjson['id'], 1);
        $this->assertEquals($rjson['source'], 'Linkedin');
        $this->assertEquals($rjson['owner'], 2);
    }

    public function test_it_cannon_get_candidate_by_id(): void
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->getJson(route('candidate.show', ['id' => 100]));

        $response->assertStatus(404);
    }

    public function test_it_can_handler_unauthorized_request(): void
    {
        $response = $this->getJson(route('candidate.list'));

        $response->assertStatus(401);
    }
}
