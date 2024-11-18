<?php

namespace App\Http\Controllers\User\Auth;

use App\Core\BaseAuthController;
use App\Services\UserAuthService;

readonly class AuthController extends BaseAuthController
{
    public function __construct(
        private UserAuthService $userAuthService
    ) {
        parent::__construct($userAuthService);
    }

    protected function getLoginView(): string
    {
        return 'user.auth.login';
    }

    protected function getRegisterView(): string
    {
        return 'user.auth.register';
    }

    protected function getRedirectRouteAfterLogin(): string
    {
        return 'home';
    }

    protected function getRedirectRouteAfterRegister(): string
    {
        return 'login';
    }
}
