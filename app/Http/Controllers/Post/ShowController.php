<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Models\PostViews;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        if (!isset($post->views)) {
            PostViews::create(['post_id' => $post->id]);
        }

        $post->views()->increment('count');

        $post->refresh();

        return new PostResource($post);
    }
}
