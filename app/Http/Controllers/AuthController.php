<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->userService = $userService;
    }

    public function login(UserLoginRequest $request)
    {
        $validatedData = $request->validated();

        if (!$token = JWTAuth::attempt($validatedData)) {
            return APIResponse::error("Unauthorized", null, 401);
        }

        if ($token instanceof \Exception) {
            return APIResponse::exception();
        }

        $user = auth()->user();
        $user->token = $token;

        return APIResponse::success("Login", $user->toArray());
    }

    public function register(UserRegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = $this->userService->store($validatedData);

        if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
            return APIResponse::error("Unable to generate token", []);
        }

        $user->token = $token;

        return APIResponse::success("Register", $user->toArray());
    }

    public function logout()
    {
        auth()->logout();

        return APIResponse::success("Successfully logged out");
    }
}
