<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Encanto Pet - Perfil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/profile/usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/i18n.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <script src="{{ asset('js/i18n/translations.js') }}"></script>
    <script src="{{ asset('js/i18n/i18n.js') }}"></script>
</head>
<body>

    {{-- ===== MODAL DE LOGOUT ===== --}}
    <div id="logoutModal" class="logout-modal-overlay">
        <div class="logout-modal-box">
            <div class="logout-modal-icon">
                <i class="ph ph-sign-out"></i>
            </div>
            <h3 data-i18n="logout.title">Sair da conta</h3>
            <p data-i18n="logout.message">Tem certeza que deseja sair da sua conta Encanto Pet?</p>
            <div class="logout-modal-buttons">
                <button type="button" onclick="closeLogoutModal()" class="btn-cancel-logout" data-i18n="logout.cancel">Cancelar</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-confirm-logout" data-i18n="logout.confirm">Sair</button>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== OVERLAY DE NOTIFICAÇÕES ===== --}}
    <div id="notifOverlay" class="notif-overlay" onclick="closeNotifications()"></div>

    {{-- ===== PAINEL DE NOTIFICAÇÕES ===== --}}
    <div id="notificationPanel" class="notification-panel">
        <div class="notification-header">
            <h3 data-i18n="notif.title">Notificações</h3>
            <button type="button" class="notif-close" onclick="closeNotifications()">
                <i class="ph ph-x"></i>
            </button>
        </div>
        <div class="notification-body">
            @php
                $allNotifOrders = auth()->check()
                    ? auth()->user()->orders()->with('items.product')->latest()->take(12)->get()
                    : collect();
                $todayNotifs     = $allNotifOrders->filter(fn($o) => $o->created_at->isToday());
                $yesterdayNotifs = $allNotifOrders->filter(fn($o) => $o->created_at->isYesterday());
                $olderNotifs     = $allNotifOrders->filter(fn($o) => !$o->created_at->isToday() && !$o->created_at->isYesterday())->take(3);
            @endphp

            @if($todayNotifs->isNotEmpty())
                <p class="notif-day-label" data-i18n="notif.today">Hoje</p>
                @foreach($todayNotifs as $order)
                    @php $fi = $order->items->first(); @endphp
                    <div class="notif-item">
                        @if($fi && $fi->product && $fi->product->image)
                            <img src="{{ asset('storage/' . $fi->product->image) }}" alt="Produto" class="notif-img">
                        @else
                            <div class="notif-img-placeholder"><i class="ph ph-shopping-bag"></i></div>
                        @endif
                        <div class="notif-text">
                            <strong><span data-i18n="notif.order_label">Pedido</span> #{{ str_pad($order->id, 2, '0', STR_PAD_LEFT) }}</strong>
                            <p><span data-i18n="notif.status_label">Status:</span> {{ ucfirst($order->status) }}</p>
                            <a href="{{ route('orders.show', $order->id) }}" data-i18n="notif.follow">Clique aqui e acompanhe</a>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($yesterdayNotifs->isNotEmpty())
                <p class="notif-day-label" data-i18n="notif.yesterday">Ontem</p>
                @foreach($yesterdayNotifs as $order)
                    @php $fi = $order->items->first(); @endphp
                    <div class="notif-item">
                        @if($fi && $fi->product && $fi->product->image)
                            <img src="{{ asset('storage/' . $fi->product->image) }}" alt="Produto" class="notif-img">
                        @else
                            <div class="notif-img-placeholder"><i class="ph ph-shopping-bag"></i></div>
                        @endif
                        <div class="notif-text">
                            <strong><span data-i18n="notif.order_label">Pedido</span> #{{ str_pad($order->id, 2, '0', STR_PAD_LEFT) }}</strong>
                            <p><span data-i18n="notif.status_label">Status:</span> {{ ucfirst($order->status) }}</p>
                            <a href="{{ route('orders.show', $order->id) }}" data-i18n="notif.follow">Clique aqui e acompanhe</a>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($olderNotifs->isNotEmpty())
                <p class="notif-day-label" data-i18n="notif.older">Anteriores</p>
                @foreach($olderNotifs as $order)
                    @php $fi = $order->items->first(); @endphp
                    <div class="notif-item">
                        @if($fi && $fi->product && $fi->product->image)
                            <img src="{{ asset('storage/' . $fi->product->image) }}" alt="Produto" class="notif-img">
                        @else
                            <div class="notif-img-placeholder"><i class="ph ph-shopping-bag"></i></div>
                        @endif
                        <div class="notif-text">
                            <strong><span data-i18n="notif.order_label">Pedido</span> #{{ str_pad($order->id, 2, '0', STR_PAD_LEFT) }}</strong>
                            <p><span data-i18n="notif.status_label">Status:</span> {{ ucfirst($order->status) }}</p>
                            <a href="{{ route('orders.show', $order->id) }}" data-i18n="notif.follow">Clique aqui e acompanhe</a>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Notificação de ofertas sempre visível --}}
            <p class="notif-day-label">{{ ($todayNotifs->isEmpty() && $yesterdayNotifs->isEmpty() && $olderNotifs->isEmpty()) ? '' : '' }}</p>
            <div class="notif-item notif-highlight">
                <i class="ph ph-tag notif-highlight-icon"></i>
                <div class="notif-text">
                    <strong data-i18n="notif.offers_title">Ofertas disponíveis</strong>
                    <p data-i18n="notif.offers_text">Que tal conferir as Ofertas da semana?</p>
                    <a href="{{ url('/#ofertas') }}" data-i18n="notif.offers_link">Clique aqui e confira</a>
                </div>
            </div>

            @if($allNotifOrders->isEmpty())
                <p class="notif-empty" data-i18n="notif.empty">Você ainda não tem pedidos. Explore as nossas ofertas!</p>
            @endif
        </div>
    </div>

    <header class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="/"><img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet"></a>
            </div>
            <nav class="menu">
                <a href="{{ url('/#produtos') }}"   data-i18n="nav.products">Produtos</a>
                <a href="{{ url('/#categorias') }}" data-i18n="nav.dogs">Cachorros</a>
                <a href="{{ url('/#categorias') }}" data-i18n="nav.cats">Gatos</a>
                <a href="{{ url('/#ofertas') }}"    data-i18n="nav.promotions">Promoções</a>
                <a href="{{ url('/#footer') }}"     data-i18n="nav.contact">Nosso contato</a>
            </nav>
            <div class="nav-right">
                <div class="icons">
                    <a href="#" onclick="toggleNotifications(event)" data-i18n-aria="nav.notification" aria-label="Notificação"><i class="ph ph-bell"></i></a>
                    <a href="{{ route('dashboard') }}" data-i18n-aria="nav.dashboard" aria-label="Minha conta"><i class="ph ph-user"></i></a>

                    {{-- Seletor de idioma --}}
                    <div class="lang-switcher">
                        <button class="lang-btn" onclick="toggleLangMenu(event)" data-i18n-aria="nav.lang_label" aria-label="Selecionar idioma">
                            <i class="ph ph-globe-hemisphere-west"></i>
                        </button>
                        <div class="lang-menu" id="langMenu">
                            <button class="lang-option" data-lang="pt_BR" onclick="setLanguage('pt_BR')">
                                <span class="lang-flag">🇧🇷</span>
                                <span data-i18n="lang.pt_BR">Português (Brasil)</span>
                            </button>
                            <button class="lang-option" data-lang="en" onclick="setLanguage('en')">
                                <span class="lang-flag">🇺🇸</span>
                                <span data-i18n="lang.en">English</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="container">
        <aside class="sidebar">
            <div class="titulo">
                <h1><span data-i18n="sidebar.title">Sua conta Encanto</span><i class="ph ph-bird"></i></h1>
            </div>

            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="ph ph-user"></i><span data-i18n="sidebar.my_account">Minha conta</span>
            </a>

            <a href="#" class="menu-item {{ request()->routeIs('notifications') ? 'active' : '' }}" onclick="toggleNotifications(event)">
                <i class="ph ph-bell-simple-ringing"></i><span data-i18n="sidebar.notifications">Notificações</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="ph ph-lock"></i><span data-i18n="sidebar.password_change">Alteração de senha</span>
            </a>

            <a href="{{ route('orders.index') }}" class="menu-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                <i class="ph ph-shopping-cart-simple"></i><span data-i18n="sidebar.my_orders">Meus pedidos</span>
            </a>

            <a href="{{ route('contact') }}" class="menu-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                <i class="ph ph-headset"></i><span data-i18n="sidebar.contact">Fale conosco</span>
            </a>

            <a href="#" class="menu-item" onclick="openLogoutModal(event)">
                <i class="ph ph-sign-out"></i><span data-i18n="sidebar.logout">Sair</span>
            </a>
        </aside>

        <main class="content">
            {{ $slot }}
        </main>

        @if(request()->routeIs('dashboard') || request()->routeIs('profile.edit') || request()->routeIs('orders.index') || request()->routeIs('favorites.index') || request()->routeIs('contact'))
            <div class="dog-decoration">
                <img src="{{ asset('assets/img/fotoperfil.svg') }}" alt="Dog">
            </div>
        @endif
    </section>

    <script>
        function openLogoutModal(e) {
            e.preventDefault();
            document.getElementById('logoutModal').classList.add('active');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.remove('active');
        }

        function toggleNotifications(e) {
            e.preventDefault();
            const panel   = document.getElementById('notificationPanel');
            const overlay = document.getElementById('notifOverlay');
            panel.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function closeNotifications() {
            document.getElementById('notificationPanel').classList.remove('open');
            document.getElementById('notifOverlay').classList.remove('active');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLogoutModal();
                closeNotifications();
                closeLangMenu();
            }
        });
    </script>
</body>
</html>
