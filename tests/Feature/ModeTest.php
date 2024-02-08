<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Mode;

class ModeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_get_all_modes()
    {
        Mode::factory()->count(3)->create();

        $response = $this->get('/admin/mode');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_store_mode()
    {
        $modeData = [
            'name' => 'Test Mode',
        ];

        $response = $this->post('/admin/mode', $modeData);

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_update_mode()
    {
        $mode = Mode::factory()->create();

        $updatedData = [
            'name' => 'Updated Mode',
        ];

        $response = $this->put("/admin/mode/{$mode->id}", $updatedData);

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_delete_mode()
    {
        $mode = Mode::factory()->create();

        $response = $this->delete("/admin/mode/{$mode->id}");

        $response->assertStatus(200);
    }
}
