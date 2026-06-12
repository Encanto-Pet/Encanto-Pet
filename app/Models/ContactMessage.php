<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_ANSWERED = 'answered';
    public const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'message',
        'status',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public static function statusOptions(): array
    {
        return [
            self::STATUS_NEW => 'Nova',
            self::STATUS_READ => 'Lida',
            self::STATUS_ANSWERED => 'Respondida',
            self::STATUS_ARCHIVED => 'Arquivada',
        ];
    }

    public static function statusValues(): array
    {
        return array_keys(self::statusOptions());
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusOptions()[$this->status] ?? ucfirst((string) $this->status);
    }

    public function getStatusClassAttribute(): string
    {
        return str_replace('_', '-', (string) $this->status);
    }

    public function markWithStatus(string $status): void
    {
        $this->update([
            'status' => $status,
            'read_at' => $status === self::STATUS_NEW ? null : ($this->read_at ?? now()),
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
