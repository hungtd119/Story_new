<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Auth\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authRepository;
    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        try {
            $tokenResult = $this->authRepository->login($request);
            return $this->responseJson('Login success', $tokenResult);
        } catch (\Exception $error) {
            return $this->responseJson('Login failed', $error);
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        try {
            $user = $this->authRepository->register($request);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("authToken")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function loadUser(Request $request)
    {
        $accessToken = $request->input('accessToken');
        if (!$accessToken) {
            return $this->responseJson('Token not found', null, 200, false);
        }
        $user = $this->authRepository->loadUser($accessToken);
        return $this->responseJson('Load user success', $user);
    }
}
