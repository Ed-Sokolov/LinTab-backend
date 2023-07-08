<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(Post $post, UpdateRequest $request)
    {
        $data = $request->validated();

        if ($post->author_id !== Auth::id()) {
            return response()->json([
                'message' => 'You are not the author of this post'
            ], Response::HTTP_FORBIDDEN);
        }

        $post->update($data);

        return new PostResource($post);
    }
}
