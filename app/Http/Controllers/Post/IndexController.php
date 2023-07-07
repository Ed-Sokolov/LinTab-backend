<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::all();

        return PostResource::collection($posts);
    }
}
