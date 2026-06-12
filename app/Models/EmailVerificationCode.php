<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerificationCode extends Model
{
    protected $fillable = ['user_id', 'code', 'attempts', 'expires_at', 'used_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at'    => 'datetime',
    ];

    public function isExpired(): bool
    {
        return now()->isAfter($this->expires_at);
    }

    public function isUsed(): bool
    {
        return $this->used_at !== null;
    }

    public function hasExceededAttempts(): bool
    {
        return $this->attempts >= 5;
    }
}
