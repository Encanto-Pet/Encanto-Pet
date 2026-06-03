<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $usersCount = User::where('role', 'user')->count();
        $products = Product::latest()->take(6)->get();
        $productsCount = Product::count();
        $archivedProductsCount = 0;

        return view('admin.dashboard', compact(
            'usersCount',
            'products',
            'productsCount',
            'archivedProductsCount'
        ));
    }
}
