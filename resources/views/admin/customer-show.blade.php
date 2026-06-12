<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Encanto Pet</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root { --yellow:#F5C518; --yellow-light:#FFF8DC; --green-light:#E8F5E9; --red-light:#FFEBEE; --blue-light:#E8F1FF; --bg:#F4F6FA; --card:#fff; --text:#242424; --muted:#7a7f87; --border:#E7E9EE; --shadow:0 2px 16px rgba(0,0,0,.07); }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--bg); color: var(--text); font-family: Nunito, sans-serif; }
        a { color: inherit; text-decoration: none; }
        .wrap { width: min(1120px, calc(100% - 32px)); margin: 0 auto; padding: 30px 0 44px; }
        .top { display: flex; align-items: center; justify-content: space-between; gap: 18px; margin-bottom: 22px; }
        h1 { margin: 0; font: 700 24px Poppins, sans-serif; }
        .sub { margin-top: 4px; color: var(--muted); font-weight: 700; font-size: 13px; }
        .btn { display: inline-flex; min-height: 38px; align-items: center; justify-content: center; padding: 9px 13px; border-radius: 8px; border: 1px solid var(--yellow); background: var(--yellow); font-weight: 900; }
        .grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
        .card, .panel { background: var(--card); border: 1px solid var(--border); border-radius: 8px; box-shadow: var(--shadow); }
        .card { padding: 18px; }
        .label { color: var(--muted); font-size: 12px; font-weight: 900; }
        .value { margin-top: 6px; font-size: 22px; font-weight: 900; }
        .panel { margin-top: 22px; padding: 22px; overflow: hidden; }
        .panel-title { font: 700 17px Poppins, sans-serif; margin-bottom: 16px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; min-width: 760px; border-collapse: collapse; }
        th { padding: 10px 12px; background: var(--bg); color: var(--muted); font-size: 12px; text-align: left; }
        td { padding: 13px 12px; border-bottom: 1px solid var(--border); font-size: 13px; vertical-align: top; }
        .badge { display: inline-flex; min-height: 24px; align-items: center; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 900; }
        .badge-entregue { background: var(--green-light); color: #24752a; }
        .badge-cancelado { background: var(--red-light); color: #a92f2f; }
        .badge-pendente, .badge-em-preparo { background: var(--yellow-light); color: #8c6900; }
        .badge-enviado { background: var(--blue-light); color: #1f62b6; }
        .empty { padding: 18px; color: var(--muted); font-weight: 800; }
        .pagination-links { margin-top: 18px; }
        .pagination-links a, .pagination-links span { display: inline-flex; min-height: 34px; align-items: center; padding: 7px 11px; border-radius: 8px; background: #fff; border: 1px solid var(--border); font-size: 12px; font-weight: 800; }
        @media (max-width: 800px) { .top { align-items: flex-start; flex-direction: column; } .grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 520px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
@php
    $statusClass = fn ($order) => 'badge-' . $order->status_class;
@endphp
<main class="wrap">
    <div class="top">
        <div>
            <h1>{{ $customer->name }}</h1>
            <div class="sub">{{ $customer->email }} · cadastrado em {{ $customer->created_at?->format('d/m/Y H:i') }}</div>
        </div>
        <a class="btn" href="{{ route('admin.dashboard', ['section' => 'clientes']) }}">Voltar aos clientes</a>
    </div>

    <section class="grid">
        <div class="card"><div class="label">ID</div><div class="value">#{{ $customer->id }}</div></div>
        <div class="card"><div class="label">Pedidos</div><div class="value">{{ $customer->orders_count }}</div></div>
        <div class="card"><div class="label">Favoritos</div><div class="value">{{ $customer->favorites_count }}</div></div>
        <div class="card"><div class="label">Total gasto</div><div class="value">R$ {{ number_format($totalSpent, 2, ',', '.') }}</div></div>
    </section>

    <section class="panel">
        <div class="panel-title">Histórico de pedidos</div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Produtos</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                @foreach($order->items as $item)
                                    <div>{{ $item->quantity }}x {{ $item->product?->name ?? 'Produto removido' }}</div>
                                @endforeach
                            </td>
                            <td>R$ {{ number_format($order->total, 2, ',', '.') }}</td>
                            <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                            <td><span class="badge {{ $statusClass($order) }}">{{ $order->status_label }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty">Este cliente ainda nao fez pedidos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-links">{{ $orders->links() }}</div>
    </section>
</main>
</body>
</html>
