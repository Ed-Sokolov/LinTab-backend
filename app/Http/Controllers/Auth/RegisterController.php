<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'nickname' => ['required', 'string', 'max:50', 'min:4', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:24', 'confirmed'],
        ]);

        $validator->setCustomMessages([
            'nickname.required' => 'The nickname is required',
            'nickname.string' => 'The nickname must be string',
            'nickname.unique' => 'The nickname already exists',
            'nickname.max' => 'The nickname must be less than 50 characters',
            'nickname.min' => 'The nickname must be more than 4 characters',
            'email.required' => 'The email is required',
            'email.string' => 'The email must be string',
            'email.unique' => 'The email already exists',
            'email.max' => 'The email must be less than 255 characters',
            'email.email' => 'The email must be email type',
            'password.required' => 'The password is required',
            'password.string' => 'The password must be string',
            'password.confirmed' => 'The password not confirmed',
            'password.min' => 'The password must be more than 8 characters',
            'password.max' => 'The password must be less than 24 characters',
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
