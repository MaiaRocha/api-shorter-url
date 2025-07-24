<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShorterUrlRequest;
use Illuminate\Support\Str;
use App\Models\ShortUrl;



class ShortUrlController extends Controller
{

    /**
     * Generates a shortened URL from an original URL provided by the user.
     *
     * Receives a JSON with the key "url" and returns a JSON containing the shortened URL.
     *
     * @param ShorterUrlRequest $request Request containing the original URL to be shortened.
     * @return \Illuminate\Http\JsonResponse Returns a JSON with the key "short_url" containing the shortened URL.
     */
    public function shorten(ShorterUrlRequest $request)
    {
        $shortCode = Str::random(6);
        ShortUrl::create([
            'original_url' => $request->url,
            'shortened_url' => $shortCode,
        ]);
        return response()->json([
            'short_url' => url("/api/s/{$shortCode}")
        ]);
    }
    /**
     * Decodes a shortened URL and returns a corresponding original URL.
     *
     * Receives the shortened code in the URL and returns a JSON with the original URL.
     *
     * @param string $shortCode Shortened URL code.
     * @return \Illuminate\Http\JsonResponse Returns a JSON with the key "short_url" containing the original URL.
     */
    public function decode($shortCode)
    {
        $shortUrl = ShortUrl::where('shortened_url', $shortCode)->firstOrFail();
        return response()->json([
            'short_url' => $shortUrl->original_url
        ]);
    }
}
