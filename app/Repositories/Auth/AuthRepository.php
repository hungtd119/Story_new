<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthRepository implements AuthInterface
{
    public function login()
    {
    }
    public function register()
    {
    }
    public function loadUser($accessToken)
    {
        $token = PersonalAccessToken::findToken($accessToken);
        $user = $token->tokenable;
        return $user;
    }
}
