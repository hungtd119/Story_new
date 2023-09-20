<?php

namespace App\Repositories\Auth;

use App\Exceptions\ErrorException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthRepository implements AuthInterface
{
    public function login($request)
    {
        $datas = $request->all();
        if (!Auth::attempt($datas)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Unauthorized'
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password, [])) {
            throw new \Exception('Error in Login');
        }

        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return $tokenResult;
    }
    public function register($request)
    {
        $datas = $request->all();
        $checkUser = User::query()->where('email', $datas['email'])->first();
        if ($checkUser)
            throw ErrorException::invalid('User existed');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $user;
    }
    public function loadUser($accessToken)
    {
        $token = PersonalAccessToken::findToken($accessToken);
        $user = $token->tokenable;
        return $user;
    }
}
