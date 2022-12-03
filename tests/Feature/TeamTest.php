<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TeamTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/teams');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(2)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/teams/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->where('name', 'teamPrueba')
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/teams/10');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/teams', [
            'name' => 'teamPrueba2',
            'number_players' => 1,
            'public' => true,
            'limit' => 5
        ]);
        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'team',
                    fn ($json) =>
                    $json->where('name', 'teamPrueba2')
                        ->etc()
                )
            );
    }

    public function test_store_errorTeam()
    {
        $response = $this->postJson('api/teams', [
            'name' => 'teamPrueba2',
            'number_players' => 1,
            'public' => true,
            'limit' => 5
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'existing database team '
            ]);
    }

    public function test_store_errorValidation()
    {
        $response = $this->postJson('api/teams', [
            'name' => '',
            'number_players' => 1,
            'public' => true,
            'limit' => 5
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'data' => 'Data incomplete '
            ]);
    }

    public function test_store_update()
    {
        $response = $this->putJson('api/teams/2', [
            'name' => 'teamPrueba3',
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 2)
                    ->where('name', 'teamPrueba3')
                    ->etc()
            );
    }

    public function test_store_updateError()
    {
        $response = $this->putJson('api/teams/22', [
            'name' => 'teamPrueba3',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store_delete()
    {
        $response = $this->delete('api/teams/2');

        $response->assertStatus(204)
            ->assertJson(null);
    }

    public function test_store_deleteError()
    {
        $response = $this->delete('api/teams/2');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
