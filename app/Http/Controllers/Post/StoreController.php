<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'];

        unset($data['image']);

        $post = Post::create($data);

        $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();

        $filePath = Storage::disk('public')->putFileAs('/images/posts', $image, $name);

        $previewName = "prev_$name";

        Image::create([
            'post_id' => $post->id,
            'alt_name' => $post->title,
            'path' => $filePath,
            'url' => url("/storage/$filePath"),
            'preview_url' => url("/storage/images/posts/$previewName")
        ]);

        \Intervention\Image\Facades\Image::make($image)
            ->fit(516, 290)
            ->save(storage_path("app/public/images/posts/$previewName"));

        return new PostResource($post);
    }
}
