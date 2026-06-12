<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Produtos</th>
                <th>Total</th>
                <th>Data</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ordersList as $order)
                <tr>
                    <td>#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <strong>{{ $order->user?->name ?? 'Cliente removido' }}</strong><br>
                        <span style="color:var(--muted)">{{ $order->user?->email }}</span>
                    </td>
                    <td>
                        @forelse($order->items as $item)
                            <div>
                                {{ $item->quantity }}x {{ $item->product?->name ?? 'Produto removido' }}
                            </div>
                        @empty
                            <span style="color:var(--muted)">Sem itens</span>
                        @endforelse
                    </td>
                    <td>R$ {{ number_format($order->total, 2, ',', '.') }}</td>
                    <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                    <td>
                        <form class="inline-form" method="POST" action="{{ route('admin.orders.status', $order) }}">
                            @csrf
                            @method('PATCH')
                            <span class="badge {{ $statusClass($order) }}">{{ $order->status_label }}</span>
                            <select class="select-mini" name="status" aria-label="Status do pedido #{{ $order->id }}">
                                @foreach($statusOptions as $value => $label)
                                    <option value="{{ $value }}" @selected($order->status === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty">Nenhum pedido encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
