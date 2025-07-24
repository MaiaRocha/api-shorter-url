<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ShortUrl;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shortens_a_url_successfully()
    {
        $response = $this->postJson('/api/shorten-url', [
            'url' => 'https://www.example.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['short_url']);

        $this->assertDatabaseHas('short_urls', [
            'original_url' => 'https://www.example.com',
        ]);
    }

    /** @test */
    public function it_requires_a_valid_url()
    {
        $response = $this->postJson('/api/shorten-url', [
            'url' => 'not-a-valid-url',
        ]);

        $response->assertStatus(422);
    }

}
