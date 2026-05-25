<x-app-layout>
    <div class="orders-overview">
        <div class="profile-info">
            <h2>Olá, {{ auth()->user()?->name }}! <br> Um remember nas suas compras?</h2>
            <p>Aqui você consegue visualizar todas os seus pedidos!</p>
        </div>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Pedidos</th>
                    <th>Produtos</th>
                    <th>Preço</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @php
                        $firstItem = $order->items->first();
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}">
                                #{{ str_pad($order->id, 2, '0', STR_PAD_LEFT) }}
                            </a>
                        </td>
                        <td class="product-column">
                            @if($firstItem && $firstItem->product)
                                <img 
                                    src="{{ asset('storage/' . $firstItem->product->image) }}"
                                    alt="{{ $firstItem->product->name }}"
                                    class="product-image"
                                >
                                @if($order->items->count() > 1)
                                    <span class="more-items">
                                        +{{ $order->items->count() - 1 }} itens
                                    </span>
                                @endif
                            @endif
                        </td>
                        <td>
                            R${{ number_format($order->total, 2, ',', '.') }}
                        </td>
                        <td>
                            <span class="status {{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>