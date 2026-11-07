<?php

namespace Modules\Auth\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Auth\App\Http\Requests\RegisterRequest;
use Modules\Auth\App\Http\Requests\LoginRequest;
use Modules\Auth\App\Http\Services\Blade\RegisterService;
use Modules\Auth\App\Http\Services\Blade\LogoutService;
use Modules\Auth\App\Http\Services\Blade\LoginService;

class AuthController extends Controller
{

    protected $loginservice;
    protected $logoutservice;
    protected $registerservice;


    public function __construct(
        LoginService $loginservice,
        LogoutService $logoutservice,
        RegisterService $registerservice

    ) {
        $this->loginservice = $loginservice;
        $this->logoutservice = $logoutservice;
        $this->registerservice = $registerservice;
    }

    public function register(RegisterRequest $request)
    {
        return $this->registerservice->__invoke($request);
    }

    public function loginForm()
    {
        return view('auth::auth.login');
    }

    public function login(LoginRequest $request)
    {
        return $this->loginservice->__invoke($request);
    }

    public function logout()
    {
        return $this->logoutservice->__invoke();
    }
}
