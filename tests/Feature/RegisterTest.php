<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_user_registration_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
    }

    /**
     *
     * @return void
     */
    public function test_user_registration_with_invalid_data()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'invalid_password',
        ]);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('users', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
    }
}
