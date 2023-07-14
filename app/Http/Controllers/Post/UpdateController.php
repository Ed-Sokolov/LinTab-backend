<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $updatedImage = $data['image'] ?? null;

        if (isset($updatedImage)) {
            $currentImage = $post->image;

            Storage::disk('public')->delete($currentImage->path);
            Storage::disk('public')->delete(str_replace('images/posts/', 'images/posts/prev_', $currentImage->path));
            $currentImage->delete();

            $name = md5(Carbon::now() . '_' . $updatedImage->getClientOriginalName()) . '.' . $updatedImage->getClientOriginalExtension();

            $filePath = Storage::disk('public')->putFileAs('/images/posts', $updatedImage, $name);

            $previewName = "prev_$name";

            Image::create([
                'post_id' => $post->id,
                'alt_name' => $post->title,
                'path' => $filePath,
                'url' => url("/storage/$filePath"),
                'preview_url' => url("/storage/images/posts/$previewName")
            ]);

            \Intervention\Image\Facades\Image::make($updatedImage)
                ->fit(516, 290)
                ->save(storage_path("app/public/images/posts/$previewName"));

            unset($data['image']);
        }

        $post->update($data);

        return new PostResource($post);
    }
}
