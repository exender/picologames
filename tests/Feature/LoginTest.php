<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_user_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_user_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalid_password',
        ]);

        dump(json_decode($response->content(), true));

        $response->assertStatus(422);
    }

    /**
     *
     * @return void
     */
    public function test_user_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertStatus(200);
    }
}
