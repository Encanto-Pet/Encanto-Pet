<aside class="sidebar">
    <div class="logo-area"><a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet"></a></div>
    <a class="nav-link {{ request()->routeIs('admin.dashboard') && request('section', 'dashboard') === 'dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="ph ph-gauge"></i>Dashboard</a>
    <a class="nav-link {{ request()->routeIs('admin.dashboard') && request('section') === 'clientes' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['section' => 'clientes']) }}"><i class="ph ph-user"></i>Minha conta</a>
    <a class="nav-link {{ request()->routeIs('admin.dashboard') && request('section') === 'produtos' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['section' => 'produtos']) }}"><i class="ph ph-shopping-cart-simple"></i>Produtos cadastrados</a>
    <a class="nav-link {{ request()->routeIs('admin.dashboard') && request('section') === 'pedidos' ? 'active' : '' }}" href="{{ route('admin.dashboard', ['section' => 'pedidos']) }}"><i class="ph ph-package"></i>Pedidos</a>
    <a class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}"><i class="ph ph-chat-circle-text"></i>Mensagens</a>
    <a class="nav-link {{ request()->routeIs('admin.password.edit') ? 'active' : '' }}" href="{{ route('admin.password.edit') }}"><i class="ph ph-lock"></i>Alterar senha</a>
    <a class="nav-link {{ request()->routeIs('admin.contact') ? 'active' : '' }}" href="{{ route('admin.contact') }}"><i class="ph ph-headset"></i>Fale conosco</a>
    <a class="nav-link" href="{{ url('/') }}"><i class="ph ph-storefront"></i>Ver loja</a>
    <form class="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-button" type="submit"><i class="ph ph-sign-out"></i>Sair</button>
    </form>
</aside>
