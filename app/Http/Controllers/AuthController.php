<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidate;
use App\Http\Requests\LoginValidate;
use App\Http\Requests\VerificationValidate;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $Auth;
    public function __construct(AuthService $auth)
    {
        $this->Auth = $auth;
    }

    public function Register(AuthValidate $request)
    {
        return $this->Auth->register($request);
    }

    public function Verification(VerificationValidate $request)
    {
        return $this->Auth->verification($request);
    }

    public function Login(LoginValidate $request)
    {
        return $this->Auth->login($request);
    }

    public function storeFcmToken(Request $request)
    {
        return $this->Auth->storeFcmToken($request);
    }

    public function getUser()
    {
        return $this->Auth->getUser();
    }

    public function update(Request $request)
    {
        return $this->Auth->update($request);
    }

    public function deleteImage()
    {
        return $this->Auth->deleteImage();
    }

    public function Logout()
    {
        return $this->Auth->logout();
    }
}
