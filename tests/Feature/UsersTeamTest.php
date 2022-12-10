<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UsersTeamTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/users_team');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(1)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/users_team/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/users_team/50');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/users_team', [
            'user_id' => 1,
            'team_id' => 1
        ]);
        $response->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('user_id', 1)
                    ->where('team_id', 1)
                    ->etc()
            );
    }

    public function test_update()
    {
        $response = $this->putJson('api/users_team/1', [
            'team_id' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('team_id', 2)
                    ->etc()
            );
    }

    public function test_updateError()
    {
        $response = $this->putJson('api/users_team/52', [
            'team_id' => 2
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_delete()
    {
        $response = $this->delete('api/users_team/1');

        $response->assertStatus(204);
    }

    public function test_deleteError()
    {
        $response = $this->delete('api/users_team/1');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
