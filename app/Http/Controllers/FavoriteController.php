<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->get();
        return view('favorites.index', compact('favorites'));
    }
}
