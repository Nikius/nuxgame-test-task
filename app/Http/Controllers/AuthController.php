<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\DeactivateRequest;
use App\Http\Requests\Auth\RegenerateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

readonly class AuthController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function registrationForm(): Factory|View
    {
        return view('registration');
    }

    public function register(RegisterRequest $request): Factory|View
    {
        $validated = $request->validated();

        $registeredUser = $this->authService->register($validated);
        $authToken = $registeredUser->userAuthToken;

        return view('auth-link', [
            'link' => '/game/' . $authToken->uuid,
            'expire_date' => $authToken->expires_at
        ]);
    }

    public function regenerate(RegenerateRequest $request): Factory|View
    {
        $validated = $request->validated();
        $authToken = $this->authService->regenerate($validated['uuid']);

        return view('auth-link', [
            'link' => '/game/' . $authToken->uuid,
            'expire_date' => $authToken->expires_at
        ]);
    }

    public function deactivate(DeactivateRequest $request): Factory|View
    {
        $validated = $request->validated();
        $this->authService->deactivate($validated['uuid']);

        return view('deactivated-link');
    }
}
