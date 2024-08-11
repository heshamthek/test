<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Post
{
    public static function find($slug)
    {
        $path = resource_path("posts/{$slug}.html");

        if (!File::exists($path)) {
            abort(404);
        }

        return Cache::remember("posts.{$slug}", 1200, function() use ($path) {
            return File::get($path);
        });
    }
}
