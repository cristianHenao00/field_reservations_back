<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->postJson('api/login', [
            'email' => 'admin@gmail.com',
            'password' => '1234'
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'user',
                    fn ($json) =>
                    $json->where('id', 1)
                        ->where('name', 'admin')
                        ->where('email', 'admin@gmail.com')
                        ->etc()
                )
                    ->has('token')
                    ->has('message')
            );
    }

    public function test_loginError()
    {
        $response = $this->postJson('api/login', [
            'email' => 'adminins@gmail.com',
            'password' => '1234'
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'error_message' => 'Incorrect Details. Please try again'
            ]);
    }
}
