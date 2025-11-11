<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class UserAuthToken extends Model
{
    const UPDATED_AT = null;

    protected $primaryKey = 'uuid';

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function registeredUser(): BelongsTo
    {
        return $this->belongsTo(RegisteredUser::class, 'user_id', 'id');
    }
}
