<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;
    protected $table = 'short_urls';
    protected $fillable = [
        'original_url',
        'shortened_url',
    ];
}
