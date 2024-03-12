<?php

namespace App\Services;

use App\Helpers\APIResponse;
use App\Models\User;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    public function store($validatedData)
    {
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            return $user;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
