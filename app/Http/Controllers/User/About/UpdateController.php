<?php

namespace App\Http\Controllers\User\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\About\UpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();

        Auth::user()->update($data);

        $responseData = [
            'status' => 'success',
            'message' => 'Update successful',
        ];

        return response($responseData, Response::HTTP_OK);
    }
}
