<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('allows admins to create edit archive and unarchive products with standardized categories', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['role' => 'admin']);

    foreach (Product::categoryValues() as $category) {
        $response = $this->actingAs($admin)->post(route('product.store'), [
            'name' => "Produto {$category}",
            'description' => 'Produto real cadastrado pelo admin.',
            'price' => 25.50,
            'stock' => 10,
            'category' => $category,
            'image' => UploadedFile::fake()->create("{$category}.jpg", 24, 'image/jpeg'),
            'redirect_to' => route('admin.dashboard', ['section' => 'produtos']),
        ]);

        $response->assertRedirect(route('admin.dashboard', ['section' => 'produtos']));
        $this->assertDatabaseHas('products', [
            'name' => "Produto {$category}",
            'category' => $category,
            'stock' => 10,
            'is_active' => true,
        ]);
    }

    $product = Product::first();

    $this->actingAs($admin)->put("/product/update/{$product->id}", [
        'name' => 'Produto atualizado',
        'description' => 'Descricao atualizada.',
        'price' => 99.99,
        'stock' => 4,
        'category' => 'higiene',
        'redirect_to' => route('admin.dashboard', ['section' => 'produtos']),
    ])->assertRedirect(route('admin.dashboard', ['section' => 'produtos']));

    expect($product->fresh())
        ->name->toBe('Produto atualizado')
        ->category->toBe('higiene')
        ->stock->toBe(4);

    $this->actingAs($admin)
        ->patch(route('admin.products.toggle-active', $product))
        ->assertRedirect();

    expect($product->fresh()->is_active)->toBeFalse();

    $this->actingAs($admin)
        ->patch(route('admin.products.toggle-active', $product))
        ->assertRedirect();

    expect($product->fresh()->is_active)->toBeTrue();
});

it('rejects invalid product category price stock and upload', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(route('product.store'), [
        'name' => 'Produto invalido',
        'description' => 'Dados invalidos.',
        'price' => 0,
        'stock' => -1,
        'category' => 'racoes',
        'image' => UploadedFile::fake()->create('manual.pdf', 12, 'application/pdf'),
    ]);

    $response->assertSessionHasErrors(['price', 'stock', 'category', 'image']);
    $this->assertDatabaseMissing('products', ['name' => 'Produto invalido']);
});

it('protects product management routes from non admin users', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->get(route('product.create'))->assertForbidden();
    auth()->logout();

    $this->get(route('product.create'))->assertRedirect(route('login'));
});
