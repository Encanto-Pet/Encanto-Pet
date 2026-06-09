<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'stock',
        'image',
        'is_active',
    ];
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function orderItems()
    {
    return $this->hasMany(OrderItem::class);
    }
}
