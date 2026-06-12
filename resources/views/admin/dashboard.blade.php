<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Encanto Pet</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <style>
        :root {
            --yellow: #f6b60b;
            --yellow-soft: #fff6d9;
            --green: #65b84a;
            --green-soft: #dff3d8;
            --red: #ef6b6b;
            --red-soft: #ffdfe2;
            --blue: #7cc7d8;
            --blue-soft: #e6f4f7;
            --bg: #f5f6fb;
            --card: #fff;
            --text: #272936;
            --muted: #8a92a3;
            --line: #edf0f6;
            --shadow: 0 16px 35px rgba(32, 45, 70, .07);
            --sidebar: 178px;
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: flex; color: var(--text); background: var(--bg); font-family: Nunito, sans-serif; }
        a { color: inherit; text-decoration: none; }
        button, input, select { font: inherit; }
        .sidebar { position: fixed; inset: 0 auto 0 0; width: var(--sidebar); padding: 30px 18px 22px; display: flex; flex-direction: column; gap: 12px; background: #fff; }
        .logo-area { display: grid; place-items: center; margin-bottom: 28px; }
        .logo-area img { width: 76px; }
        .nav-link, .logout-button { min-height: 34px; display: flex; align-items: center; gap: 12px; border: 0; border-bottom: 2px solid transparent; padding: 6px 0; color: #1e2430; background: transparent; font-size: 14px; font-weight: 800; cursor: pointer; text-align: left; }
        .nav-link i, .logout-button i { width: 19px; font-size: 19px; }
        .nav-link.active { border-bottom-color: var(--yellow); }
        .nav-link:hover, .logout-button:hover { color: var(--yellow); }
        .logout-form { margin-top: auto; }
        .main { width: calc(100% - var(--sidebar)); margin-left: var(--sidebar); }
        .topbar { height: 56px; padding: 0 34px 0 22px; display: flex; align-items: center; justify-content: space-between; gap: 24px; background: #fff; }
        .search-bar { width: min(410px, 48vw); height: 36px; display: flex; align-items: center; gap: 10px; border-radius: 10px; padding: 0 14px; background: #eef4fa; color: #9eb5c4; }
        .search-bar input { width: 100%; border: 0; outline: 0; color: #617080; background: transparent; font-size: 12px; font-weight: 800; }
        .topbar-right { display: flex; align-items: center; gap: 15px; color: #7ab5c4; }
        .admin-face { width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center; overflow: hidden; background: var(--yellow); }
        .admin-face img { width: 100%; height: 100%; object-fit: cover; }
        .admin-name { color: var(--text); font-size: 12px; font-weight: 900; line-height: 1; }
        .admin-role { color: var(--muted); font-size: 11px; font-weight: 800; }
        .content { padding: 34px clamp(18px, 3vw, 38px) 46px; }
        .notice { max-width: 760px; margin-bottom: 18px; border-radius: 10px; padding: 12px 16px; color: #2f6c22; background: var(--green-soft); font-weight: 900; }
        .hero-head { position: relative; min-height: 140px; display: flex; justify-content: space-between; gap: 24px; }
        .page-title { margin: 0; font-size: 28px; font-weight: 900; line-height: 1; letter-spacing: 0; }
        .page-subtitle { margin: 9px 0 0; color: var(--muted); font-size: 12px; font-weight: 800; }
        .dog-badge { width: 144px; height: 144px; margin-right: clamp(8px, 7vw, 96px); border-radius: 44% 56% 54% 46%; display: grid; place-items: end center; overflow: hidden; background: var(--yellow); }
        .dog-badge img { width: 116px; height: 116px; object-fit: contain; }
        .stats-row { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px; margin-top: 22px; }
        .stat-card { min-height: 88px; border-radius: 12px; padding: 18px 20px; display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; background: #fff; box-shadow: var(--shadow); }
        .stat-label { color: #777e8b; font-size: 14px; font-weight: 800; }
        .stat-hint { max-width: 120px; margin-top: 1px; color: #aeb5c2; font-size: 8px; font-weight: 800; line-height: 1.1; }
        .stat-value { margin-top: 14px; color: #3d3f49; font-size: 26px; font-weight: 900; }
        .stat-icon { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; font-size: 23px; }
        .stat-icon.blue { color: #4eaec1; background: #cdeff5; }
        .stat-icon.yellow { color: #d99200; background: #fff0bd; }
        .stat-icon.green { color: #4da13e; background: #d9f2d2; }
        .stat-icon.red { color: #d84646; background: #ffd6da; }
        .panel { margin-top: 24px; border-radius: 12px; padding: 24px; background: #fff; box-shadow: var(--shadow); }
        .panel-header { display: flex; align-items: center; justify-content: space-between; gap: 18px; margin-bottom: 18px; }
        .panel-title { font-size: 18px; font-weight: 900; }
        .mini-select { height: 28px; border: 1px solid var(--line); border-radius: 6px; padding: 0 10px; color: #b0b6c1; background: #fff; font-size: 11px; font-weight: 800; }
        .chart-box { height: 260px; }
        .chart-box svg { width: 100%; height: 100%; overflow: visible; }
        .chart-grid { stroke: #edf0f4; stroke-width: 1; }
        .chart-area { fill: url(#salesFill); }
        .chart-line { fill: none; stroke: var(--yellow); stroke-width: 3; stroke-linecap: round; stroke-linejoin: round; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; min-width: 780px; border-collapse: separate; border-spacing: 0 9px; }
        th { height: 36px; padding: 0 16px; color: #65707d; background: #eaf3f4; font-size: 12px; font-weight: 900; text-align: left; }
        th:first-child { border-radius: 9px 0 0 9px; }
        th:last-child { border-radius: 0 9px 9px 0; }
        td { padding: 12px 16px; color: #596270; background: #fff; border-bottom: 1px solid #f0f2f6; font-size: 12px; font-weight: 800; vertical-align: middle; }
        .badge { display: inline-flex; align-items: center; min-height: 24px; border-radius: 999px; padding: 4px 12px; font-size: 11px; font-weight: 900; white-space: nowrap; }
        .badge-active, .badge-entregue { color: #fff; background: var(--green); }
        .badge-archived, .badge-cancelado { color: #fff; background: var(--red); }
        .badge-pendente, .badge-em-preparo { color: #5c4300; background: var(--yellow-soft); }
        .badge-enviado { color: #1e6575; background: var(--blue-soft); }
        .btn, .select-mini, .field { min-height: 34px; border-radius: 8px; border: 1px solid var(--line); font-size: 12px; font-weight: 900; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 8px 12px; color: #303341; background: #fff; cursor: pointer; transition: transform .18s, box-shadow .18s; }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 10px 18px rgba(32,45,70,.09); }
        .btn-primary { border-color: var(--yellow); background: var(--yellow); }
        .btn-danger { border-color: #ffd4d8; color: #c73737; background: #fff1f2; }
        .btn-blue { border-color: #d5edf2; color: #4c9dad; background: #eef8fa; }
        .select-mini { padding: 0 9px; color: #596270; background: #fff; }
        .field { width: min(100%, 330px); padding: 0 12px; outline: 0; background: #f1f6fb; }
        .inline-form { display: inline-flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .section-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 24px; }
        .prod-stats { width: min(100%, 640px); display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 48px; margin-top: 26px; }
        .shelf-title { margin-top: 44px; font-size: 19px; font-weight: 900; }
        .shelf-link { display: inline-block; margin-top: 4px; color: var(--yellow); border-bottom: 2px solid var(--yellow); font-size: 13px; font-weight: 900; }
        .products-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 34px; margin-top: 24px; }
        .product-card { position: relative; min-height: 420px; border-radius: 14px; overflow: hidden; background: #fff; box-shadow: var(--shadow); transition: transform .18s, box-shadow .18s; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 22px 42px rgba(32,45,70,.1); }
        .product-card.archived { opacity: .76; }
        .product-status { position: absolute; top: 14px; left: 14px; z-index: 2; }
        .product-image { height: 245px; display: grid; place-items: center; background: #fff; }
        .product-image img { max-width: 76%; max-height: 190px; object-fit: contain; filter: drop-shadow(0 13px 16px rgba(32,45,70,.14)); }
        .product-info { min-height: 175px; padding: 22px 24px; background: #fff; }
        .product-name { color: #2c2f39; font-size: 16px; line-height: 1.2; font-weight: 900; }
        .product-price { margin-top: 8px; color: #62b7c9; font-size: 15px; font-weight: 900; }
        .stars { margin-top: 6px; color: #ff9e00; font-size: 13px; font-weight: 900; }
        .stars span { color: #a0a7b3; font-size: 11px; }
        .product-meta { margin-top: 14px; color: #8d95a2; font-size: 10px; font-weight: 900; line-height: 1.1; }
        .product-meta strong { display: block; color: #303341; font-size: 12px; }
        .product-actions { position: absolute; right: 18px; bottom: 12px; display: flex; gap: 14px; align-items: center; }
        .icon-action { border: 0; padding: 4px; color: #69afbf; background: transparent; font-size: 18px; cursor: pointer; }
        .icon-action.danger { color: #f05b5b; }
        .empty { padding: 28px; color: var(--muted); font-weight: 900; }
        .pagination-links { margin-top: 26px; display: flex; justify-content: center; }
        .pagination-links nav { display: flex; gap: 9px; flex-wrap: wrap; }
        .pagination-links a, .pagination-links span { min-width: 34px; min-height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #dbe3ed; padding: 7px 11px; color: #7c8491; background: #fff; font-size: 12px; font-weight: 900; }
        .pagination-links span[aria-current="page"] span, .pagination-links span[aria-current="page"] { color: #fff; background: var(--yellow); border-color: var(--yellow); }
        @media (max-width: 1120px) {
            .stats-row, .products-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .dog-badge { margin-right: 0; }
        }
        @media (max-width: 760px) {
            body { display: block; }
            .sidebar { position: static; width: 100%; display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 8px 18px; }
            .logo-area { grid-column: 1 / -1; margin-bottom: 8px; }
            .logout-form { margin-top: 0; }
            .main { width: 100%; margin-left: 0; }
            .topbar { height: auto; padding: 14px 18px; flex-wrap: wrap; }
            .search-bar { width: 100%; }
            .hero-head, .section-top { flex-direction: column; }
            .dog-badge { width: 116px; height: 116px; }
            .stats-row, .products-grid, .prod-stats { grid-template-columns: 1fr; }
            .panel { padding: 16px; }
        }
    </style>
</head>
<body>
@php
    $currentSection = $section ?? 'dashboard';
    $statusClass = fn ($order) => 'badge-' . $order->status_class;
    $chartValues = $salesChartPoints->pluck('value');
    $chartMax = max((float) $chartValues->max(), 1);
    $chartCount = max($salesChartPoints->count(), 1);
    $chartLine = $salesChartPoints->values()->map(function ($point, $index) use ($chartMax, $chartCount) {
        $x = 20 + ($chartCount === 1 ? 0 : ($index / ($chartCount - 1)) * 860);
        $y = 210 - (((float) $point['value']) / $chartMax * 165);
        return round($x, 2) . ',' . round($y, 2);
    })->implode(' ');
    $chartArea = $chartLine ? '20,230 ' . $chartLine . ' 880,230' : '';
@endphp

<aside class="sidebar">
    <div class="logo-area"><a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet"></a></div>
    <a class="nav-link {{ $currentSection === 'dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="ph ph-gauge"></i>Dashboard</a>
    <a class="nav-link {{ $currentSection === 'clientes' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['section' => 'clientes']) }}"><i class="ph ph-user"></i>Minha conta</a>
    <a class="nav-link {{ $currentSection === 'produtos' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['section' => 'produtos']) }}"><i class="ph ph-shopping-cart-simple"></i>Produtos cadastrados</a>
    <a class="nav-link {{ $currentSection === 'pedidos' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['section' => 'pedidos']) }}"><i class="ph ph-package"></i>Pedidos</a>
    <a class="nav-link" href="{{ route('admin.messages.index') }}"><i class="ph ph-chat-circle-text"></i>Mensagens</a>
    <a class="nav-link" href="{{ route('admin.password.edit') }}"><i class="ph ph-lock"></i>Alterar senha</a>
    <a class="nav-link" href="{{ route('admin.contact') }}"><i class="ph ph-headset"></i>Fale conosco</a>
    <a class="nav-link" href="{{ url('/') }}"><i class="ph ph-storefront"></i>Ver loja</a>
    <form class="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-button" type="submit"><i class="ph ph-sign-out"></i>Sair</button>
    </form>
</aside>

<main class="main">
    <header class="topbar">
        <form class="search-bar" method="GET" action="{{ route('admin.dashboard') }}">
            <input type="hidden" name="section" value="clientes">
            <input name="customer_search" value="{{ $customerSearch }}" placeholder="Pesquise produtos...">
            <i class="ph ph-magnifying-glass"></i>
        </form>
        <div class="topbar-right">
            <div class="admin-face"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div>
            <div><div class="admin-name">{{ auth()->user()->name }}</div><div class="admin-role">Adm</div></div>
            <i class="ph ph-heart"></i><i class="ph ph-globe-hemisphere-west"></i><i class="ph ph-bell"></i>
        </div>
    </header>

    <section class="content">
        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif

        @if($currentSection === 'dashboard')
            <div class="hero-head">
                <div>
                    <h1 class="page-title">Olá, Adm! <span style="color:var(--yellow)">👋</span></h1>
                    <p class="page-subtitle">Aqui você tem os insights gerais do seu Pet Shop!</p>
                    <div class="stats-row">
                        <div class="stat-card"><div><div class="stat-label">Total de clientes</div><div class="stat-value">{{ number_format($usersCount, 0, ',', '.') }}</div></div><div class="stat-icon blue"><i class="ph ph-target"></i></div></div>
                        <div class="stat-card"><div><div class="stat-label">Total de pedidos</div><div class="stat-value">{{ number_format($ordersCount, 0, ',', '.') }}</div></div><div class="stat-icon yellow"><i class="ph ph-archive-box"></i></div></div>
                        <div class="stat-card"><div><div class="stat-label">Vendas totais</div><div class="stat-value">R$ {{ number_format($totalSold, 2, ',', '.') }}</div></div><div class="stat-icon green"><i class="ph ph-chart-line-up"></i></div></div>
                        <div class="stat-card"><div><div class="stat-label">Pedidos pendentes</div><div class="stat-value">{{ number_format($pendingOrdersCount, 0, ',', '.') }}</div></div><div class="stat-icon red"><i class="ph ph-clock-counter-clockwise"></i></div></div>
                        <div class="stat-card"><div><div class="stat-label">Mensagens novas</div><div class="stat-value">{{ number_format($newMessagesCount, 0, ',', '.') }}</div></div><div class="stat-icon blue"><i class="ph ph-chat-circle-text"></i></div></div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header"><div class="panel-title">Detalhe de vendas</div><select class="mini-select"><option>Últimos pedidos</option></select></div>
                <div class="chart-box">
                    <svg viewBox="0 0 900 250" role="img" aria-label="Gráfico de vendas">
                        <defs>
                            <linearGradient id="salesFill" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0" stop-color="#f6b60b" stop-opacity=".28"/>
                                <stop offset="1" stop-color="#f6b60b" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        @for($i = 0; $i < 5; $i++)
                            <line class="chart-grid" x1="20" x2="880" y1="{{ 45 + ($i * 41) }}" y2="{{ 45 + ($i * 41) }}"/>
                        @endfor
                        @if($chartLine)
                            <polygon class="chart-area" points="{{ $chartArea }}"/>
                            <polyline class="chart-line" points="{{ $chartLine }}"/>
                        @else
                            <text x="380" y="130" fill="#9ca3af" font-weight="800">Sem vendas ainda</text>
                        @endif
                    </svg>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header"><div class="panel-title">Últimas vendas</div><select class="mini-select"><option>Outubro</option></select></div>
                @include('admin.partials.orders-table', ['ordersList' => $latestOrders, 'statusOptions' => $statusOptions, 'statusClass' => $statusClass])
            </div>
        @endif

        @if($currentSection === 'produtos')
            <div class="section-top">
                <div>
                    <h1 class="page-title">Olá, Adm! <span style="color:var(--yellow)">👋</span></h1>
                    <p class="page-subtitle">Cadastre mais produtos e aumente a sua variedade.</p>
                    <div class="prod-stats">
                        <div class="stat-card"><div><div class="stat-label">Produtos Cadastrados</div><div class="stat-value">{{ $productsCount }}</div></div><div class="stat-icon green"><i class="ph ph-paw-print"></i></div></div>
                        <div class="stat-card"><div><div class="stat-label">Produtos Arquivados</div><div class="stat-hint">Clique para visualizar os produtos que foram arquivados</div><div class="stat-value">{{ $archivedProductsCount }}</div></div><div class="stat-icon red"><i class="ph ph-paw-print"></i></div></div>
                    </div>
                </div>
                <div class="dog-badge"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div>
            </div>

            <div class="shelf-title">Sua prateleira</div>
            <a class="shelf-link" href="{{ route('product.create') }}">Cadastre um novo produto</a>

            <div class="products-grid">
                @forelse($products as $product)
                    <article class="product-card {{ $product->is_active ? '' : 'archived' }}">
                        <span class="badge product-status {{ $product->is_active ? 'badge-active' : 'badge-archived' }}">{{ $product->is_active ? 'Ativo' : 'Arquivado' }}</span>
                        <div class="product-image"><img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/cachorro-feliz.svg') }}" alt="{{ $product->name }}"></div>
                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                            <div class="stars">★★★★<span>★ ({{ $product->favorites_count ?? 0 }})</span></div>
                            <div class="product-meta">Categoria<strong>{{ $product->category_label }}</strong></div>
                        </div>
                        <div class="product-actions">
                            <a class="icon-action" href="{{ url('/product/edit/' . $product->id) }}" title="Editar"><i class="ph ph-pencil-simple"></i></a>
                            <form method="POST" action="{{ route('admin.products.toggle-active', $product) }}">
                                @csrf
                                @method('PATCH')
                                <button class="icon-action danger" type="submit" title="{{ $product->is_active ? 'Arquivar' : 'Desarquivar' }}"><i class="ph {{ $product->is_active ? 'ph-x' : 'ph-arrow-clockwise' }}"></i></button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="empty">Nenhum produto cadastrado.</div>
                @endforelse
            </div>
            <div class="pagination-links">{{ $products->links() }}</div>
        @endif

        @if($currentSection === 'pedidos')
            <div class="panel-header"><div><h1 class="page-title">Pedidos</h1><p class="page-subtitle">Pedidos reais feitos pelos clientes.</p></div></div>
            <div class="panel">
                @include('admin.partials.orders-table', ['ordersList' => $orders, 'statusOptions' => $statusOptions, 'statusClass' => $statusClass])
                <div class="pagination-links">{{ $orders->links() }}</div>
            </div>
        @endif

        @if($currentSection === 'clientes')
            <div class="panel-header">
                <div><h1 class="page-title">Clientes</h1><p class="page-subtitle">Usuários cadastrados, pedidos e favoritos.</p></div>
                <form class="inline-form" method="GET" action="{{ route('admin.dashboard') }}">
                    <input type="hidden" name="section" value="clientes">
                    <input class="field" name="customer_search" value="{{ $customerSearch }}" placeholder="Nome ou e-mail">
                    <button class="btn btn-primary" type="submit"><i class="ph ph-magnifying-glass"></i>Pesquisar</button>
                </form>
            </div>
            <div class="panel">
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Cadastro</th><th>Pedidos</th><th>Favoritos</th><th></th></tr></thead>
                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>#{{ $customer->id }}</td><td><strong>{{ $customer->name }}</strong></td><td>{{ $customer->email }}</td><td>{{ $customer->created_at?->format('d/m/Y H:i') }}</td><td>{{ $customer->orders_count }}</td><td>{{ $customer->favorites_count }}</td>
                                    <td><a class="btn btn-blue" href="{{ route('admin.customers.show', $customer) }}">Detalhes</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="empty">Nenhum cliente encontrado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-links">{{ $customers->links() }}</div>
            </div>
        @endif
    </section>
</main>
</body>
</html>
