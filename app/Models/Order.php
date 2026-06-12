<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    const PENDING = 'pendente';
    const PREPARING = 'em_preparo';
    const SHIPPED = 'enviado';
    const DELIVERED = 'entregue';
    const CANCELED = 'cancelado';

    public static function statusOptions(): array
    {
        return [
            self::PENDING => 'Pendente',
            self::PREPARING => 'Em preparo',
            self::SHIPPED => 'Enviado',
            self::DELIVERED => 'Entregue',
            self::CANCELED => 'Cancelado',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusOptions()[$this->status] ?? match ($this->status) {
            'pending' => 'Pendente',
            'em preparo' => 'Em preparo',
            'shipped' => 'Enviado',
            'delivered' => 'Entregue',
            'cancelled', 'canceled' => 'Cancelado',
            default => ucfirst((string) $this->status),
        };
    }

    public function getStatusClassAttribute(): string
    {
        return str_replace(' ', '-', match ($this->status) {
            'pending' => self::PENDING,
            'em preparo' => self::PREPARING,
            'shipped' => self::SHIPPED,
            'delivered' => self::DELIVERED,
            'cancelled', 'canceled' => self::CANCELED,
            default => (string) $this->status,
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function items()
    {
    return $this->hasMany(OrderItem::class);
    }
}
