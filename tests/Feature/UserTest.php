<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_get_user_by_id()
    {
        $user = User::factory()->create();

        $response = $this->get("/user/{$user->id}");

        $response->assertStatus(200);

        $response->assertExactJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     *
     * @return void
     */
    public function test_edit_user()
    {
        $user = User::factory()->create();

        $response = $this->get("/user/edit/{$user->id}");

        $response->assertStatus(200);

        $response->assertExactJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     *
     * @return void
     */
    public function test_update_user()
    {
        $user = User::factory()->create();

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'updated_password',
        ];

        $response = $this->put("/user/update/{$user->id}", $updatedData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', $updatedData);
    }
}
