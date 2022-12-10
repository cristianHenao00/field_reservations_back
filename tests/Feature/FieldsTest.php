<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FieldsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/fields');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(2)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/fields/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/fields/50');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/fields', [
            'field_type' => 'grama',
            'field_characteristic' => 'cancha de grama para futbol 8',
            'field_location' => 'calle 8 # 12 - 33'
        ]);
        $response->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'field',
                    fn ($json) =>
                    $json->where('field_type', 'grama')
                        ->where('field_characteristic', 'cancha de grama para futbol 8')
                        ->where('field_location', 'calle 8 # 12 - 33')
                        ->etc()
                )
            );
    }

    public function test_store_errorValidation()
    {
        $response = $this->postJson('api/fields', [
            'field_type' => '',
            'field_characteristic' => 'cancha de grama para futbol 8',
            'field_location' => 'calle 8 # 12 - 33'
        ]);
        $response->assertStatus(400)
            ->assertJson(
                ['data' => 'Data incomplete ']
            );
    }

    public function test_store_errorFields()
    {
        $response = $this->postJson('api/fields', [
            'field_type' => 'grama',
            'field_characteristic' => 'cancha de grama para futbol 8',
            'field_location' => 'calle 8 # 12 - 33'
        ]);
        $response->assertStatus(404)
            ->assertJson(
                ['message' => 'existing database field ']
            );
    }

    public function test_update()
    {
        $response = $this->putJson('api/fields/1', [
            'field_characteristic' => 'cancha de grama para futbol 11'
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
        $response = $this->putJson('api/fields/52', [
            'field_characteristic' => 'cancha de grama para futbol 11'
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_delete()
    {
        $response = $this->delete('api/fields/3');

        $response->assertStatus(204);
    }

    public function test_deleteError()
    {
        $response = $this->delete('api/fields/3');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
