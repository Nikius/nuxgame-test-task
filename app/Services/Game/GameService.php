<?php

namespace App\Services\Game;

use App\Models\GamesHistory;
use App\Models\RegisteredUser;
use Illuminate\Database\Eloquent\Collection;

class GameService
{
    public function play(RegisteredUser $user): int
    {
        $result = $this->processGame();
        GamesHistory::create(['user_id' => $user->id, 'result' => $result]);

        return $result;
    }

    public function getHistory(RegisteredUser $user): Collection
    {
        return $user->getLastGamesBy(config('project_settings.history.list_count'));
    }

    private function processGame(): int
    {
        $randomNumber = rand(1, 1000);

        if ($randomNumber % 2 !== 0)
            return 0;

        if ($randomNumber > 900)
            return $randomNumber * 0.7;

        if ($randomNumber > 600)
            return $randomNumber * 0.5;

        if ($randomNumber > 300)
            return $randomNumber * 0.3;

        return $randomNumber * 0.1;
    }
}
