<x-app-layout>
    <div class="orders-overview">
        <div class="profile-info">
            <h2>Pedido #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h2>
            <p>Realizado em {{ $order->created_at?->format('d/m/Y H:i') }}</p>
        </div>

        <table class="orders-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product?->name ?? 'Produto removido' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 24px; display: flex; gap: 18px; align-items: center; flex-wrap: wrap;">
            <strong>Total: R$ {{ number_format($order->total, 2, ',', '.') }}</strong>
            <span class="order-status {{ $order->status_class }}">{{ $order->status_label }}</span>
            <a href="{{ route('orders.index') }}">Voltar aos pedidos</a>
        </div>
    </div>
</x-app-layout>
