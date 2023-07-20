<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Avatar\AvatarResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'nickname' => $this->nickname,
            'name' => $this->name,
            'about' => $this->about,
            'email' => $this->email,
            'avatar' => isset($this->avatar) ? new AvatarResource($this->avatar) : null
        ];
    }
}
