<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ShortUrl;

class ShortUrlFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can shorten a URL using the API.
     *
     * Sends a POST request and checks if the shortened URL is returned
     * and stored in the database.
     */
    public function user_can_shorten_a_url()
    {
        $response = $this->postJson('/api/shorten-url', [
            'url' => 'https://laravel.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['short_url']);

        $this->assertDatabaseHas('short_urls', [
            'original_url' => 'https://laravel.com',
        ]);
    }

    /**
     * Test if a user can decode a previously shortened URL.
     *
     * Creates a shortened URL and sends a GET request to retrieve
     * the original URL from it.
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
    }
}
