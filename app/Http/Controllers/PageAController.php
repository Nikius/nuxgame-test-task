<?php

namespace App\Http\Controllers;

use App\Exceptions\ExpiredException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Game\HistoryRequest;
use App\Http\Requests\Game\PlayRequest;
use App\Models\UserAuthToken;
use App\Services\Auth\AuthService;
use App\Services\Game\GameService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

readonly class PageAController
{
    public function __construct(
        private AuthService $authService,
        private GameService $gameService
    )
    {
    }

    public function game(string $uuid): Factory|View
    {
        $this->authorize($uuid);

        return view('game', [
            'uuid' => $uuid
        ]);
    }

    public function play(PlayRequest $request): Factory|View
    {
        $validated = $request->validated();
        $authToken = $this->authorize($validated['uuid']);

        $result = $this->gameService->play($authToken->registeredUser);

        return view('result', [
            'result' => $result
        ]);
    }

    public function history(HistoryRequest $request): Factory|View
    {
        $validated = $request->validated();
        $authToken = $this->authorize($validated['uuid']);

        $games = $this->gameService->getHistory($authToken->registeredUser);

        return view('history', [
            'games' => $games
        ]);
    }

    private function authorize(string $uuid): UserAuthToken
    {
        try {
            $authToken = $this->authService->validateToken($uuid);
        } catch (NotFoundException $e) {
            abort(404, $e->getMessage());
        } catch (ExpiredException $e) {
            abort(401, $e->getMessage());
        }

        return $authToken;
    }
}
