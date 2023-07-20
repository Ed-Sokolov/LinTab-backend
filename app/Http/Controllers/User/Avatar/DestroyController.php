<?php

namespace App\Http\Controllers\User\Avatar;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $currentAvatar = $user->avatar;

        if (isset($currentAvatar)) {
            Storage::disk('public')->delete($currentAvatar->path);
            Storage::disk('public')->delete(str_replace('images/avatars/', 'images/avatars/prev_', $currentAvatar->path));
            $currentAvatar->delete();
        }

        $user->refresh();

        return new UserResource($user);
    }
}
