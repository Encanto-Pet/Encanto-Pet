<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public const CATEGORY_OPTIONS = [
        'racao' => 'Ração',
        'petisco' => 'Petisco',
        'brinquedos' => 'Brinquedos',
        'higiene' => 'Higiene',
        'outros' => 'Outros',
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'stock',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function categoryOptions(): array
    {
        return self::CATEGORY_OPTIONS;
    }

    public static function categoryValues(): array
    {
        return array_keys(self::CATEGORY_OPTIONS);
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORY_OPTIONS[$this->category] ?? self::CATEGORY_OPTIONS['outros'];
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function orderItems()
    {
    return $this->hasMany(OrderItem::class);
    }
}
