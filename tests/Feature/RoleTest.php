<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/roles');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(2)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/roles/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->where('name', 'Administrador')
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/roles/10');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/roles', [
            'name' => 'Prueba1'
        ]);
        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'role',
                    fn ($json) =>
                    $json->where('name', 'Prueba1')
                        ->etc()
                )
            );
    }

    public function test_store_errorRole()
    {
        $response = $this->postJson('api/roles', [
            'name' => 'Prueba1'
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'existing database role '
            ]);
    }

    public function test_store_errorValidation()
    {
        $response = $this->postJson('api/roles', [
            'name' => '',
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'data' => 'Data incomplete '
            ]);
    }

    public function test_store_update()
    {
        $response = $this->putJson('api/roles/2', [
            'name' => 'Prueba2',
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 2)
                    ->where('name', 'Prueba2')
                    ->etc()
            );
    }

    public function test_store_updateError()
    {
        $response = $this->putJson('api/roles/22', [
            'name' => 'Prueba2',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store_delete()
    {
        $response = $this->delete('api/roles/2');

        $response->assertStatus(204)
            ->assertJson(null);
    }

    public function test_store_deleteError()
    {
        $response = $this->delete('api/roles/2');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
