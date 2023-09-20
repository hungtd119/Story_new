<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;

interface AuthInterface
{
    public function login();
    public function register();
    public function loadUser($accessToken);
}
