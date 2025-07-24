<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShorterUrlRequest;
use Illuminate\Support\Str;
use App\Models\ShortUrl;

   

class ShortUrlController extends Controller
{
    public function shorten(ShorterUrlRequest $request) {
        $shortCode = Str::random(6);
        ShortUrl::create([
            'original_url' => $request->url,
            'shortened_url' => $shortCode,
        ]);
        return response()->json([
            'short_url' => url("/api/s/{$shortCode}")
        ]);
    }
    public function decode($shortCode) {
        $shortUrl = ShortUrl::where('shortened_url', $shortCode)->firstOrFail();
        return response()->json([
            'short_url' => $shortUrl->original_url
        ]);
    }
}
