<?php

namespace App\Services;

use App\Helpers\APIResponse;
use App\Models\User;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    private static $instance;

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    public function store($validatedData)
    {
        try {
            $user = $this->userModel->create([
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
