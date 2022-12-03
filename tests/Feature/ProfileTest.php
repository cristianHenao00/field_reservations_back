<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/profiles');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(2)
            );
    }

    public function test_show()
    {
        $response = $this->get('api/profiles/1');

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    public function test_show_error()
    {
        $response = $this->get('api/profiles/10');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store()
    {
        $response = $this->postJson('api/profiles', [
            'user_id' => 2,
            'phone_number' => '123456789',
            'url_facebook' => '/prueba',
            'image' => '/pruebaImg.png'
        ]);
        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('user_id', 2)
                    ->etc()
            );
    }

    public function test_store_errorExtension()
    {
        $response = $this->postJson('api/profiles', [
            'user_id' => 2,
            'phone_number' => '123456789',
            'url_facebook' => '/prueba',
            'image' => '/pruebaImg.jpeg'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'An image must be uploaded '
            ]);
    }

    public function test_store_errorValitacion()
    {
        $response = $this->postJson('api/profiles', [
            'user_id' => 2,
            'phone_number' => '123456789',
            'url_facebook' => '/prueba',
            'image' => '/pruebaImg.png'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'The user already has a profile '
            ]);
    }

    public function test_store_update()
    {
        $response = $this->putJson('api/profiles/2', [
            'phone_number' => '222256789',
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 2)
                    ->where('phone_number', '222256789')
                    ->etc()
            );
    }

    public function test_store_updateError()
    {
        $response = $this->putJson('api/profiles/22', [
            'phone_number' => '222256789',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }

    public function test_store_delete()
    {
        $response = $this->delete('api/profiles/2');

        $response->assertStatus(204)
            ->assertJson(null);
    }

    public function test_store_deleteError()
    {
        $response = $this->delete('api/profiles/2');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Not found'
            ]);
    }
}
