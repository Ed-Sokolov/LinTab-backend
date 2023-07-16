<?php

namespace App\Http\Controllers\User\Avatar;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Avatar\UpdateRequest;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();
    }
}
