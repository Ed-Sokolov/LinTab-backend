<?php

namespace App\Http\Controllers\User\Avatar;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Avatar\UpdateRequest;
use App\Models\Avatar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();

        $newAvatar = $data['avatar'];

        $user = Auth::user();

        $currentAvatar = $user->avatar_id;

        if ($currentAvatar !== null) {
            Storage::disk('public')->delete($currentAvatar->path);
            Storage::disk('public')->delete(str_replace('images/avatars/', 'images/avatars/prev_', $currentAvatar->path));
            $currentAvatar->delete();
        }

        $name = md5(Carbon::now() . '_' . $newAvatar->getClientOriginalName()) . '.' . $newAvatar->getClientOriginalExtension();

        $filePath = Storage::disk('public')->putFileAs('/images/avatars', $newAvatar, $name);

        $previewName = "prev_$name";

        $avatar = Avatar::create([
            'alt_name' => "$user->nickname's avatar",
            'path' => $filePath,
            'url' => url("/storage/$filePath"),
            'preview_url' => url("/storage/images/avatars/$previewName")
        ]);

        \Intervention\Image\Facades\Image::make($newAvatar)
            ->fit(100, 100)
            ->save(storage_path("app/public/images/avatars/$previewName"));

        $user->update(['avatar_id' => $avatar->id]);

        return response($user);
    }
}
