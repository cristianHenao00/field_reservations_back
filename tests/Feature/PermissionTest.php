<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/permissions');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(5)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/permissions/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->where('url', '/users')
                    ->where('method', 'GET')
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/permissions/50');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/permissions', [
            'url' => '/pruebas1',
            'method' => 'GET'
        ]);
        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'permission',
                    fn ($json) =>
                    $json->where('url', '/prueba1')
                        ->where('method', 'GET')
                        ->etc()
                )
            );
    }

    public function test_store_errorPermission()
    {
        $response = $this->postJson('api/permission', [
            'url' => '/pruebas1',
            'method' => 'GET'
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'existing database role '
            ]);
    }

    public function test_store_errorValidation()
    {
        $response = $this->postJson('api/permission', [
            'url' => '/pruebas1',
            'method' => ''
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'data' => 'Data incomplete '
            ]);
    }

    public function test_store_update()
    {
        $response = $this->putJson('api/permission/2', [
            'url' => '/pruebas2',
            'method' => 'GET'
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('url', '/pruebas2')
                    ->where('method', 'GET')
                    ->etc()
            );
    }

    public function test_store_updateError()
    {
        $response = $this->putJson('api/permission/52', [
            'url' => '/pruebas2',
            'method' => 'GET'
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store_delete()
    {
        $response = $this->delete('api/permission/2');

        $response->assertStatus(204)
            ->assertJson(null);
    }

    public function test_store_deleteError()
    {
        $response = $this->delete('api/permission/2');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
