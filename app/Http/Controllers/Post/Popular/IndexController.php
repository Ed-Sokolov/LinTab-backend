<?php

namespace App\Http\Controllers\Post\Popular;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $popularPosts = Post::all()->take(3);

        return PostResource::collection($popularPosts);
    }
}
