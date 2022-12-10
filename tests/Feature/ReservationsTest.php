<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ReservationsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/reservations');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(1)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/reservations/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/reservations/50');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/reservations', [
            'team_id' => 2,
            'field_id' => 1,
            'date' => '2023-01-20',
            'hour' => '13:00:00',
            'experation' => '14:00:00'
        ]);
        $response->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'reservation',
                    fn ($json) =>
                    $json->where('team_id', 2)
                        ->where('field_id', 1)
                        ->etc()
                )
            );
    }

    public function test_store_errorValidation()
    {
        $response = $this->postJson('api/reservations', [
            'team_id' => 1,
            'field_id' => '',
            'date' => '2023-01-20',
            'hour' => '13:00:00',
            'experation' => '14:00:00'
        ]);
        $response->assertStatus(400)
            ->assertJson(
                ['data' => 'Data incomplete ']
            );
    }

    public function test_store_errorReservation()
    {
        $response = $this->postJson('api/reservations', [
            'team_id' => 2,
            'field_id' => 1,
            'date' => '2023-01-20',
            'hour' => '13:00:00',
            'experation' => '14:00:00'
        ]);
        $response->assertStatus(404)
            ->assertJson(
                ['message' => 'existing database reservation ']
            );
    }

    public function test_update()
    {
        $response = $this->putJson('api/reservations/1', [
            'experation' => '19:00:00'
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
        $response = $this->putJson('api/reservations/52', [
            'experation' => '19:00:00'
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_delete()
    {
        $response = $this->delete('api/reservations/2');

        $response->assertStatus(204);
    }

    public function test_deleteError()
    {
        $response = $this->delete('api/reservations/2');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
