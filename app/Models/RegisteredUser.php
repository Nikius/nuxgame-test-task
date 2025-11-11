<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RegisteredUser extends Model
{
    protected $fillable = [
        'username',
        'phonenumber',
    ];

    public function userAuthToken(): HasOne
    {
        return $this->hasOne(UserAuthToken::class, 'user_id');
    }

    public function gameHistory(): HasMany
    {
        return $this->hasMany(GamesHistory::class, 'user_id');
    }

    public function getLastGamesBy(int $count): Collection
    {
        return $this->gameHistory()->orderByDesc('created_at')->take($count)->get();
    }
}
