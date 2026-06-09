<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - {{ config('app.name', 'Encanto Pet') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet">
                </a>
            </div>

            <nav class="menu">
                <a href="/#produtos">Produtos</a>
                <a href="/#categorias">Cachorros</a>
                <a href="/#categorias">Gatos</a>
                <a href="/#ofertas">Promoções</a>
                <a href="#">Adote aqui!</a>
                <a href="#footer">Nosso contato</a>
            </nav>

            <div class="nav-right">
                <div class="search">
                    <input type="text" placeholder="Pesquise produtos...">
                    <span><img src="{{ asset('assets/icon/lupa.svg') }}" alt="Pesquisar"></span>
                </div>

                @if (Route::has('login'))
                    <div class="home-auth-links">
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a class="register-link" href="{{ route('register') }}">Registre-se</a>
                            @endif
                        @endauth
                    </div>
                @endif

                <div class="icons">
                    <a href="#" aria-label="Notificação"><i class="ph ph-bell"></i></a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" aria-label="Dashboard"><i class="ph ph-user"></i></a>
                        @else
                            <a href="{{ route('login') }}" aria-label="Login"><i class="ph ph-user"></i></a>
                        @endauth
                    @endif
                    <a href="#" aria-label="Internacionalização"><i class="ph ph-globe-hemisphere-west"></i></a>
                    <a class="cart-icon" href="{{ route('checkout') }}" aria-label="Carrinho">
                        <i class="ph ph-shopping-cart-simple"></i>
                        <span id="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    @php
        $fallbackSubtotal = $products->sum(fn ($product) => (float) $product->price);
    @endphp

    <main class="checkout-page-public">
        <section class="checkout-body">
            <span class="bone-deco" aria-hidden="true">🦴</span>

            <div class="checkout-left">
                <h1 class="checkout-page-title">Seu pet autorizou esse pagamento :)</h1>
                <p class="checkout-page-sub">Selecione o método de pagamento</p>

                <div class="order-items" id="checkout-items">
                    @forelse($products as $product)
                        <div class="order-item">
                            <div class="order-item-img">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <span>🐾</span>
                                @endif
                            </div>
                            <div class="order-item-text">
                                <div class="order-item-name">{{ $product->name }}</div>
                                <div class="order-item-desc">{{ $product->description }}</div>
                                <div class="order-item-price">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="checkout-empty">
                            <strong>Seu carrinho está vazio.</strong>
                            <a href="/#produtos">Escolher produtos</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <aside class="checkout-right">
                <div class="order-summary">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal:</span>
                        <span
                            class="summary-value"
                            id="checkout-subtotal"
                            data-fallback="R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}"
                        >R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Taxas</span>
                        <span class="summary-free">Frete Grátis</span>
                    </div>
                    <hr>
                    <div class="summary-row summary-total">
                        <span class="summary-label">Total:</span>
                        <span
                            class="summary-value"
                            id="checkout-total"
                            data-fallback="R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}"
                        >R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}</span>
                    </div>
                </div>

                <div class="payment-section">
                    <button class="payment-option" type="button" onclick="selectPayment(this)">
                        <span class="radio-circle selected"><span class="radio-dot"></span></span>
                        Cartão de crédito
                    </button>
                    <button class="payment-option" type="button" onclick="selectPayment(this)">
                        <span class="radio-circle"></span>
                        Cartão de débito
                    </button>
                    <button class="payment-option" type="button" onclick="selectPayment(this)">
                        <span class="radio-circle"></span>
                        Pix
                    </button>
                </div>

                <button class="btn-checkout" type="button" onclick="finishCheckout()">Finalizar pagamento!</button>
            </aside>

            <div class="checkout-pet-deco" aria-hidden="true"><img src="{{ asset('assets/img/gato-pagamento.svg') }}" alt=""></div>
            <div class="checkout-paw-deco" aria-hidden="true">🐾 🐾</div>
        </section>

        <div class="checkout-back">
            <a href="/#produtos">← Voltar aos produtos</a>
        </div>
    </main>

    <footer id="footer">
        <div>
            <h4>🐾 Encanto Pet</h4>
            <p>Obrigado pela visita. Seu pet provavelmente já está escolhendo a próxima compra.</p>
        </div>
        <div>
            <h4>Adote Aqui</h4>
            <ul>
                <li>Cachorros</li>
                <li>Gatos</li>
                <li>Pássaros</li>
            </ul>
        </div>
        <div>
            <h4>Contatos</h4>
            <ul>
                <li>contato@encantopet.com</li>
                <li>(11) 99999-9999</li>
            </ul>
        </div>
        <div>
            <h4>Endereço</h4>
            <ul>
                <li>São Paulo, SP</li>
                <li>Encanto Pet</li>
            </ul>
        </div>
    </footer>
    <div class="footer-bottom">© 2026 Encanto Pet</div>

    <div id="toast"></div>
</body>
</html>
