<?php

namespace App\Core;

use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Services\AbstractAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

abstract readonly class BaseAuthController
{
    public function __construct(
        protected AbstractAuthService $authService,
    ) {
    }

    abstract protected function getLoginView(): string;

    abstract protected function getRegisterView(): string;

    abstract protected function getRedirectRouteAfterLogin(): string;

    abstract protected function getRedirectRouteAfterRegister(): string;

    public function indexLogin(): View
    {
        return view($this->getLoginView());
    }

    public function indexRegister(): View
    {
        return view($this->getRegisterView());
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (!$this->authService->login($request->toCredentials())) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        return redirect()->route($this->getRedirectRouteAfterLogin());
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->authService->register($request->validated());

        return redirect()->route($this->getRedirectRouteAfterRegister());
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->route('login');
    }
}
