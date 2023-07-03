<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckAuth extends Controller
{
    public function __invoke()
    {
        Auth::user();
        return response(Auth::user());
    }
}
