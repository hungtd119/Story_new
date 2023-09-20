<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;

interface AuthInterface
{
    public function login($request);
    public function register($request);
    public function loadUser($accessToken);
}
