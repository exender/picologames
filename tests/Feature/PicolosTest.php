<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Picolo;

class PicoloControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_get_all_picolos()
    {
        Picolo::factory()->count(3)->create();

        $response = $this->get('/admin/picolo');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_get_suggested_picolos()
    {
        Picolo::factory()->count(2)->create(['published' => 0]);

        $response = $this->get('/admin/picolo/suggested');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_validate_picolo()
    {
        $picolo = Picolo::factory()->create(['published' => 0]);

        $response = $this->post("/admin/picolo/validate/{$picolo->id}");

        $response->assertStatus(200);

        $this->assertEquals(1, Picolo::find($picolo->id)->published);
    }
}
