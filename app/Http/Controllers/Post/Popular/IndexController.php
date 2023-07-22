<?php

namespace App\Http\Controllers\Post\Popular;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCardResource;
use App\Models\Post;
use App\Models\PostViews;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('views')
            ->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
            ->select('posts.*', 'post_views.count as view_count')
            ->orderByDesc('view_count')
            ->limit(3)
            ->get();

        return PostCardResource::collection($posts);
    }
}
