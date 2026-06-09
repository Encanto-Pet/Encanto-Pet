<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

it('creates an order from checkout cart items', function () {
    $user = User::factory()->create();
    $product = Product::create([
        'name' => 'Racao Golden',
        'description' => 'Pacote 10kg',
        'price' => 150,
        'category' => 'Racao',
        'stock' => 8,
        'is_active' => true,
    ]);

    $response = $this->actingAs($user)->postJson(route('orders.store'), [
        'payment_method' => 'pix',
        'address' => [
            'street' => 'Rua Amapas',
            'zip' => '11111-111',
            'city' => 'Cotia',
            'number' => '9',
            'complement' => 'Jardim Angela',
        ],
        'items' => [
            ['id' => $product->id, 'quantity' => 2],
        ],
    ]);

    $response->assertCreated();

    $order = Order::with('items.product')->first();

    expect($order)
        ->user_id->toBe($user->id)
        ->total->toEqual(300.00)
        ->items->toHaveCount(1);

    expect($order->items->first())
        ->product_id->toBe($product->id)
        ->quantity->toBe(2)
        ->price->toEqual(150.00);
});
