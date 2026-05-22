<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;

use App\Models\Product;
use App\Models\Order;
use App\Models\Favorite;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user=auth()->user();
    $favoritesCount = $user->favorites()->count();
    $ordersCount = $user->orders()->count();

    return view('dashboard',[
        'favoritesCount' => $favoritesCount,
        'ordersCount' => $ordersCount,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/store', [ProductController::class, 'store']);
    Route::get('/product/edit/{product}', [ProductController::class, 'edit']);
    Route::post('/product/update/{product}', [ProductController::class, 'update']);
    Route::get('/product/delete/{product}', [ProductController::class, 'delete']);
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}',[OrderController::class, 'show'])->name('orders.show');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

});

require __DIR__.'/auth.php';
