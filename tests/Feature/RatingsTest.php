<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RatingsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/ratings');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(2)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/ratings/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/ratings/50');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/ratings', [
            'field_id' => 2,
            'rating' => 3.5,
            'comment' => 'mala'
        ]);
        $response->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('field_id', 2)
                    ->where('rating', 3.5)
                    ->etc()
            );
    }

    public function test_update()
    {
        $response = $this->putJson('api/ratings/1', [
            'comment' => 'genial'
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_updateError()
    {
        $response = $this->putJson('api/ratings/52', [
            'comment' => 'genial'
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_delete()
    {
        $response = $this->delete('api/ratings/3');

        $response->assertStatus(204);
    }

    public function test_deleteError()
    {
        $response = $this->delete('api/ratings/3');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
