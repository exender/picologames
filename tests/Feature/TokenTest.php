<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\PersonalAccessToken;

class TokenControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_get_tokenable_id_with_valid_token_id()
    {
        $user = User::factory()->create();

        $token = $user->createToken('test-token')->plainTextToken;

        $tokenId = PersonalAccessToken::where('token', $token)->first()->id;

        $response = $this->get("/token/{$tokenId}");

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_get_tokenable_id_with_invalid_token_id()
    {
        $response = $this->get('/token/invalid-token-id');

        $response->assertStatus(404);
    }

    // Add more tests for other scenarios as needed...
}
