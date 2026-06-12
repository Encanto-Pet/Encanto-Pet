<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $section = $request->query('section', 'dashboard');
        $customerSearch = trim((string) $request->query('customer_search', ''));

        $usersCount = User::where('role', 'user')->count();
        $productsCount = Product::where('is_active', true)->count();
        $archivedProductsCount = Product::where('is_active', false)->count();
        $ordersCount = Order::count();
        $pendingOrdersCount = Order::whereIn('status', [Order::PENDING, 'pending'])->count();
        $newMessagesCount = ContactMessage::where('status', ContactMessage::STATUS_NEW)->count();
        $totalSold = Order::whereNotIn('status', [Order::CANCELED, 'cancelled', 'canceled'])
            ->sum('total');

        $products = Product::latest()
            ->paginate(9, ['*'], 'products_page')
            ->withQueryString();

        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(10, ['*'], 'orders_page')
            ->withQueryString();

        $customers = User::where('role', 'user')
            ->withCount(['orders', 'favorites'])
            ->when($customerSearch !== '', function ($query) use ($customerSearch) {
                $query->where(function ($query) use ($customerSearch) {
                    $query->where('name', 'like', "%{$customerSearch}%")
                        ->orWhere('email', 'like', "%{$customerSearch}%");
                });
            })
            ->latest()
            ->paginate(10, ['*'], 'customers_page')
            ->withQueryString();

        $latestOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        $salesChartPoints = Order::latest()
            ->take(30)
            ->get(['total', 'created_at'])
            ->sortBy('created_at')
            ->values()
            ->map(fn (Order $order) => [
                'label' => $order->created_at?->format('d/m'),
                'value' => (float) $order->total,
            ]);

        $statusOptions = Order::statusOptions();

        return view('admin.dashboard', compact(
            'section',
            'usersCount',
            'products',
            'productsCount',
            'archivedProductsCount',
            'ordersCount',
            'pendingOrdersCount',
            'newMessagesCount',
            'totalSold',
            'orders',
            'latestOrders',
            'salesChartPoints',
            'customers',
            'customerSearch',
            'statusOptions'
        ));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:' . implode(',', array_keys(Order::statusOptions()))],
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status do pedido atualizado com sucesso.');
    }

    public function toggleProductStatus(Product $product)
    {
        $product->update(['is_active' => ! $product->is_active]);

        $message = $product->is_active
            ? 'Produto desarquivado com sucesso.'
            : 'Produto arquivado com sucesso.';

        return back()->with('success', $message);
    }

    public function showCustomer(User $user)
    {
        abort_unless(strtolower((string) $user->role) === 'user', 404);

        $user->loadCount(['orders', 'favorites']);

        $orders = $user->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalSpent = $user->orders()
            ->whereNotIn('status', [Order::CANCELED, 'cancelled', 'canceled'])
            ->sum('total');

        return view('admin.customer-show', [
            'customer' => $user,
            'orders' => $orders,
            'totalSpent' => $totalSpent,
            'statusOptions' => Order::statusOptions(),
        ]);
    }
}
