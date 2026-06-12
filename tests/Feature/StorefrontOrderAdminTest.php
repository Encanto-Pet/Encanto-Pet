<?php

use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

it('shows only active products on home with standardized filter categories', function () {
    $active = Product::create([
        'name' => 'Racao Boa',
        'description' => 'Pacote ativo.',
        'price' => 49.90,
        'category' => 'racao',
        'stock' => 5,
        'is_active' => true,
    ]);

    Product::create([
        'name' => 'Produto Arquivado',
        'description' => 'Nao deve aparecer na vitrine.',
        'price' => 25,
        'category' => 'petisco',
        'stock' => 3,
        'is_active' => false,
    ]);

    Product::create([
        'name' => 'Categoria Antiga',
        'description' => 'Produto antigo ativo.',
        'price' => 15,
        'category' => 'Racao Antiga',
        'stock' => 2,
        'is_active' => true,
    ]);

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee($active->name);
    $response->assertDontSee('Produto Arquivado');
    $response->assertSee('data-category="racao"', false);
    $response->assertSee('data-category="outros"', false);
});

it('blocks inactive and out of stock products and creates orders with stock decrement', function () {
    $user = User::factory()->create(['role' => 'user']);

    $active = Product::create([
        'name' => 'Racao em estoque',
        'description' => 'Produto disponivel.',
        'price' => 20,
        'category' => 'racao',
        'stock' => 5,
        'is_active' => true,
    ]);

    $inactive = Product::create([
        'name' => 'Petisco arquivado',
        'description' => 'Produto indisponivel.',
        'price' => 10,
        'category' => 'petisco',
        'stock' => 4,
        'is_active' => false,
    ]);

    $outOfStock = Product::create([
        'name' => 'Brinquedo sem estoque',
        'description' => 'Produto sem estoque.',
        'price' => 30,
        'category' => 'brinquedos',
        'stock' => 0,
        'is_active' => true,
    ]);

    $basePayload = [
        'payment_method' => 'pix',
        'address' => [
            'street' => 'Rua Amapas',
            'zip' => '11111-111',
            'city' => 'Cotia',
            'number' => '9',
            'complement' => 'Jardim Angela',
        ],
    ];

    $this->actingAs($user)->postJson(route('orders.store'), $basePayload + [
        'items' => [['id' => $inactive->id, 'quantity' => 1]],
    ])->assertStatus(422);

    $this->actingAs($user)->postJson(route('orders.store'), $basePayload + [
        'items' => [['id' => $outOfStock->id, 'quantity' => 1]],
    ])->assertStatus(422);

    $response = $this->actingAs($user)->postJson(route('orders.store'), $basePayload + [
        'items' => [
            ['id' => $active->id, 'quantity' => 2],
            ['id' => $active->id, 'quantity' => 1],
        ],
    ]);

    $response->assertCreated();

    $order = Order::with('items.product')->first();

    expect($order)
        ->user_id->toBe($user->id)
        ->status->toBe(Order::PENDING)
        ->total->toEqual(60.00)
        ->items->toHaveCount(1);

    expect($order->items->first())
        ->product_id->toBe($active->id)
        ->quantity->toBe(3)
        ->price->toEqual(20.00);

    expect($active->fresh()->stock)->toBe(2);
});

it('lets admins update order status and the customer sees the updated status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'user']);
    $product = Product::create([
        'name' => 'Produto do pedido',
        'description' => 'Descricao.',
        'price' => 35,
        'category' => 'outros',
        'stock' => 8,
        'is_active' => true,
    ]);

    $order = Order::create([
        'user_id' => $customer->id,
        'total' => 70,
        'status' => Order::PENDING,
    ]);

    $order->items()->create([
        'product_id' => $product->id,
        'quantity' => 2,
        'price' => 35,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.orders.status', $order), ['status' => Order::PREPARING])
        ->assertRedirect();

    expect($order->fresh()->status)->toBe('em_preparo');

    $this->actingAs($customer)
        ->get(route('orders.index'))
        ->assertOk()
        ->assertSee('Em preparo');

    $this->actingAs($admin)
        ->patch(route('admin.orders.status', $order), ['status' => 'separando'])
        ->assertSessionHasErrors('status');
});

it('shows real admin dashboard customer data and customer details', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create([
        'role' => 'user',
        'name' => 'Maria Cliente',
        'email' => 'maria@example.com',
    ]);
    $otherCustomer = User::factory()->create(['role' => 'user', 'name' => 'Outro Cliente']);
    $product = Product::create([
        'name' => 'Higiene Premium',
        'description' => 'Produto real.',
        'price' => 40,
        'category' => 'higiene',
        'stock' => 6,
        'is_active' => true,
    ]);

    Favorite::create(['user_id' => $customer->id, 'product_id' => $product->id]);

    $order = Order::create([
        'user_id' => $customer->id,
        'total' => 80,
        'status' => Order::DELIVERED,
    ]);

    $order->items()->create([
        'product_id' => $product->id,
        'quantity' => 2,
        'price' => 40,
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'clientes', 'customer_search' => 'maria']))
        ->assertOk()
        ->assertSee('Maria Cliente')
        ->assertSee('maria@example.com')
        ->assertDontSee($otherCustomer->email);

    $this->actingAs($admin)
        ->get(route('admin.customers.show', $customer))
        ->assertOk()
        ->assertSee('Maria Cliente')
        ->assertSee('Entregue')
        ->assertSee('R$ 80,00');

    $this->actingAs($customer)->get(route('admin.dashboard'))->assertForbidden();
    auth()->logout();

    $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
});
