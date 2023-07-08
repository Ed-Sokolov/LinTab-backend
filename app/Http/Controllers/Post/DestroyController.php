<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        if ($post->author_id !== auth()->id) {
            return response()->json([
                'message' => 'You are not the author of this post'
            ], Response::HTTP_FORBIDDEN);
        }

        $post->delete();

        return response()->json([
           'message' => 'Post deleted successfully'
        ], Response::HTTP_NO_CONTENT);
    }
}
