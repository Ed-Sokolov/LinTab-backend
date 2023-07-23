<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Image\PreviewImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author_id' => $this->author_id,
            'preview' => new PreviewImageResource($this->image),
            'views' => $this->views->count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
