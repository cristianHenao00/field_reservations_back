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
                $json->has(2)

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
            'url' => '/permissions',
            'method' => 'GET'
        ]);
        $response->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'permission',
                    fn ($json) =>
                    $json->where('url', '/permissions')
                        ->where('method', 'GET')
                        ->etc()
                )
            );
    }

    public function test_store_errorPermission()
    {
        $response = $this->postJson('api/permissions', [
            'url' => '/permissions',
            'method' => 'GET'
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'existing database permission '
            ]);
    }

    public function test_store_errorValidation()
    {
        $response = $this->postJson('api/permissions', [
            'url' => '/permission',
            'method' => ''
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'data' => 'Data incomplete '
            ]);
    }

    public function test_update()
    {
        $response = $this->putJson('api/permissions/2', [
            'url' => '/pruebas'
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 2)
                    ->where('url', '/pruebas')
                    ->etc()
            );
    }

    public function test_updateError()
    {
        $response = $this->putJson('api/permissions/52', [
            'url' => '/pruebas',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_delete()
    {
        $response = $this->delete('api/permissions/3');

        $response->assertStatus(204);
    }

    public function test_deleteError()
    {
        $response = $this->delete('api/permissions/3');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
