<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['nullable', 'integer', 'min:1'],
            'address.street' => ['required', 'string', 'max:255'],
            'address.zip' => ['required', 'string', 'max:20'],
            'address.city' => ['required', 'string', 'max:120'],
            'address.number' => ['required', 'string', 'max:20'],
            'address.complement' => ['nullable', 'string', 'max:255'],
            'payment_method' => ['required', 'string', 'max:40'],
        ]);

        $quantities = collect($validated['items'])
            ->groupBy('id')
            ->map(fn ($items) => $items->sum(fn ($item) => max((int) ($item['quantity'] ?? 1), 1)));

        $order = DB::transaction(function () use ($quantities) {
            $products = Product::whereIn('id', $quantities->keys())
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            if ($products->count() !== $quantities->count() || $products->contains(fn ($product) => ! $product->is_active)) {
                abort(response()->json([
                    'message' => 'Um ou mais produtos selecionados nao estao disponiveis.',
                ], 422));
            }

            foreach ($quantities as $productId => $quantity) {
                if ((int) $products[$productId]->stock < $quantity) {
                    abort(response()->json([
                        'message' => 'Estoque insuficiente para um ou mais produtos selecionados.',
                    ], 422));
                }
            }

            $total = $quantities->reduce(function ($sum, $quantity, $productId) use ($products) {
                return $sum + ((float) $products[$productId]->price * $quantity);
            }, 0);

            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => Order::PENDING,
            ]);

            $quantities->each(function ($quantity, $productId) use ($order, $products) {
                $product = $products[$productId];

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);

                $product->decrement('stock', $quantity);
            });

            return $order;
        });

        return response()->json([
            'order_id' => $order->id,
            'orders_url' => route('orders.index'),
        ], 201);
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id() || auth()->user()->isAdmin(), 403);

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }
}
