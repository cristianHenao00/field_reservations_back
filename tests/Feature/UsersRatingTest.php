<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UsersRatingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/users_rating');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(1)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/users_rating/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/users_rating/50');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/users_rating', [
            'user_id' => 1,
            'rating_id' => 2,
        ]);
        $response->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('user_id', 1)
                    ->where('rating_id', 2)
                    ->etc()
            );
    }


    public function test_updateError()
    {
        $response = $this->putJson('api/users_rating/52', [
            'rating_id' => 1,
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_delete()
    {
        $response = $this->delete('api/users_rating/2');

        $response->assertStatus(204);
    }

    public function test_deleteError()
    {
        $response = $this->delete('api/users_rating/2');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
