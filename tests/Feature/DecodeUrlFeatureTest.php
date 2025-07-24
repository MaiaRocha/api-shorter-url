<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ShortUrl;

class DecodeUrlFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can decode a valid shortened URL.
     *
     * Creates a shortened URL and sends a GET request to decode it,
     * then asserts the response and database content.
     */
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

    /**
     * Test if the API returns a 404 response for an invalid short code.
     *
     * Sends a GET request with a non-existent short code and
     * expects a 404 Not Found response.
     */
    public function it_returns_404_for_invalid_short_code()
    {
        $response = $this->getJson('/api/s/invalid');
        $response->assertStatus(404);
    }
}
