<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/users');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(2)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/users/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->where('name', 'admin')
                    ->where('email', 'admin@gmail.com')
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/users/10');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/users', [
            'name' => 'prueba',
            'email' => 'pueba@gmail.com',
            'password' => '5555',
            'role_id' => 1
        ]);
        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'user',
                    fn ($json) =>
                    $json->where('name', 'prueba')
                        ->where('email', 'pueba@gmail.com')
                        ->etc()
                )
                    ->has('token')
            );
    }

    public function test_store_errorValidation()
    {
        $response = $this->postJson('api/users', [
            'name' => '',
            'email' => 'pueba@gmail.com',
            'password' => "5555",
            'role_id' => 1
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'data' => 'Data incomplete '
            ]);
    }

    public function test_store_errorEmail()
    {
        $response = $this->postJson('api/users', [
            'name' => 'pueba12',
            'email' => 'pueba@gmail.com',
            'password' => "6666",
            'role_id' => 1
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'data' => 'Data incomplete '
            ]);
    }

    public function test_store_update()
    {
        $response = $this->putJson('api/users/2', [
            'name' => 'admin3',
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 2)
                    ->where('name', 'admin3')
                    ->etc()
            );
    }

    public function test_store_updateError()
    {
        $response = $this->putJson('api/users/5', [
            'name' => 'admin3',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store_delete()
    {
        $response = $this->delete('api/users/2');

        $response->assertStatus(204)
            ->assertJson(null);
    }

    public function test_store_deleteError()
    {
        $response = $this->delete('api/users/6');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
