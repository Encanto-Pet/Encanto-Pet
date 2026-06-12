<x-app-layout>
    <div class="orders-overview">
        <div class="profile-info">
            <h2 data-i18n="orders.greeting" data-i18n-name="{{ auth()->user()?->name }}">Olá, {{ auth()->user()?->name }}! <br> Um remember nas suas compras?</h2>
            <p data-i18n="orders.subtitle">Aqui você consegue visualizar todas os seus pedidos!</p>
        </div>
        @if($orders->isEmpty())
            <div class="orders-empty">
                <i class="ph ph-shopping-cart-simple"></i>
                <h3 data-i18n="orders.none">Nenhum pedido encontrado</h3>
                <p data-i18n="orders.none_desc">Você ainda não realizou nenhum pedido. Que tal explorar os nossos produtos?</p>
                <a href="{{ url('/#produtos') }}" class="btn-explore" data-i18n="orders.see_products">Ver produtos</a>
            </div>
        @else
        <table class="orders-table">
            <thead>
                <tr>
                    <th data-i18n="orders.col_orders">Pedidos</th>
                    <th data-i18n="orders.col_products">Produtos</th>
                    <th data-i18n="orders.col_price">Preço</th>
                    <th data-i18n="orders.col_status">Status</th>
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
                                    <span class="more-items"
                                        data-i18n="orders.more_items"
                                        data-i18n-n="{{ $order->items->count() - 1 }}">
                                        +{{ $order->items->count() - 1 }} itens
                                    </span>
                                @endif
                            @endif
                        </td>
                        <td>
                            R${{ number_format($order->total, 2, ',', '.') }}
                        </td>
                        <td>
                            <span class="order-status {{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>
