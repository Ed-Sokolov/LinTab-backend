<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $user->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
