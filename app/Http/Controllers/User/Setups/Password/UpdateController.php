<?php

namespace App\Http\Controllers\User\Setups\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Setups\Password\UpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        $isOldPassword = Hash::check($data['old_password'], $user->password);

        if (!$isOldPassword) {
            return response(['old_password' => 'Old Password is wrong'], Response::HTTP_UNAUTHORIZED);
        }

        $user->update([
           'password' => Hash::make($data['new_password'])
        ]);

        $user->refresh();

        return new UserResource($user);
    }
}
