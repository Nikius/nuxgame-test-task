<?php

namespace App\Services\Auth;

use App\Exceptions\ExpiredException;
use App\Exceptions\NotFoundException;
use App\Models\RegisteredUser;
use App\Models\UserAuthToken;
use Illuminate\Support\Str;

class AuthService
{
    public function register(array $data): RegisteredUser
    {
        $registeredUser = RegisteredUser::updateOrCreate($data);
        $registeredUser->userAuthToken()->updateOrCreate([
            'user_id' => $registeredUser->id,
            'expires_at' => $this->getNextExpiresAt()
        ]);

        return $registeredUser;
    }

    public function regenerate(string $uuid): UserAuthToken
    {
        $authToken = UserAuthToken::find($uuid);
        $authToken->uuid = (string) Str::uuid();
        $authToken->expires_at = $this->getNextExpiresAt();
        $authToken->save();

        return $authToken;
    }

    public function deactivate(string $uuid): void
    {
        UserAuthToken::where('uuid', $uuid)->update([
            'expires_at' => time()
        ]);
    }

    /**
     * @throws NotFoundException
     * @throws ExpiredException
     */
    public function validateToken(string $uuid): UserAuthToken
    {
        $authToken = UserAuthToken::where('uuid', $uuid)->first();

        if (!$authToken)
            throw new NotFoundException('Link not found');

        if (now()->greaterThan($authToken->expires_at))
            throw new ExpiredException('Link expired');

        return $authToken;
    }

    private function getNextExpiresAt(): int
    {
        return time() + config('project_settings.auth_token.expires_after', 3600*24*7);
    }
}
