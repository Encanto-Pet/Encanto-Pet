<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }
    public function show(Order $order)
    {
        return view('orders.show', compact('orders'));
    }
}
