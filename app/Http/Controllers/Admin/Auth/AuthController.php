<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Core\BaseAuthController;
use App\Services\AdminAuthService;

readonly class AuthController extends BaseAuthController
{
    public function __construct(
        private AdminAuthService $adminAuthService,
    ) {
        parent::__construct($adminAuthService);
    }

    protected function getLoginView(): string
    {
        return 'admin.auth.login';
    }

    protected function getRegisterView(): string
    {
        return 'admin.auth.register';
    }

    protected function getRedirectRouteAfterLogin(): string
    {
        return 'admin.dashboard';
    }

    protected function getRedirectRouteAfterRegister(): string
    {
        return 'admin.login';
    }
}
