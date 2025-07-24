<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ShortUrl;

class DecodeUrlFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_decode_a_shortened_url()
    {
        $shortUrl = ShortUrl::create([
            'original_url' => 'https://laravel.com',
            'shortened_url' => 'laravel',
        ]);

        $response = $this->getJson('/api/s/laravel');

        $response->assertStatus(200)
            ->assertJson([
                'short_url' => 'https://laravel.com',
            ]);

        $this->assertDatabaseHas('short_urls', [
            'original_url' => 'https://laravel.com',
            'shortened_url' => 'laravel',
        ]);
    }

    /** @test */
    public function it_returns_404_for_invalid_short_code()
    {
        $response = $this->getJson('/api/s/invalid');
        $response->assertStatus(404);
    }
}
