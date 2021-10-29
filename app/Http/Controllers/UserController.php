<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authorization(Request $request)
    {
        $user = User::where($request->only(['email', 'password']))->first();
        if (!$user) {
            throw new ApiException(401, 'Неправильные логин или пароль');
        }
        Auth::login($user);
        return [
            'data' => [
                'token' => Auth::user()->generateToken()
            ]
        ];
    }

    public function registration(RegistrationRequest $request)
    {
        return response()->json([
            'data' => [
                'token' => User::create($request->all())->generateToken()
            ]
        ])->setStatusCode(201);
    }
}
