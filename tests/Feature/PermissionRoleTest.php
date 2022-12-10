<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PermissionRoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/permission_role');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(2)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/permission_role/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/permission_role/50');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/permission_role', [
            'role_id' => 2,
            'permission_id' => 1
        ]);
        $response->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('role_id', 2)
                    ->where('permission_id', 1)
                    ->etc()
            );
    }

    public function test_update()
    {
        $response = $this->putJson('api/permission_role/2', [
            'role_id' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('role_id', 2)
                    ->etc()
            );
    }

    public function test_updateError()
    {
        $response = $this->putJson('api/permission_role/52', [
            'permission_id' => '13',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_delete()
    {
        $response = $this->delete('api/permission_role/3');

        $response->assertStatus(204);
    }

    public function test_deleteError()
    {
        $response = $this->delete('api/permission_role/3');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
