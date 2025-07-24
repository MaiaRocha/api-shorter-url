<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ShortUrl;

class DecodeUrlTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_decodes_a_shortened_url()
    {
        $shortUrl = ShortUrl::create([
            'original_url' => 'https://www.example.com',
            'shortened_url' => 'abc123',
        ]);

        $response = $this->getJson('/api/s/abc123');

        $response->assertStatus(200)
            ->assertJson([
                'short_url' => 'https://www.example.com',
            ]);
    }

    /** @test */
    public function it_returns_404_for_invalid_short_code()
    {
        $response = $this->getJson('/api/s/invalid');
        $response->assertStatus(404);
    }
}
