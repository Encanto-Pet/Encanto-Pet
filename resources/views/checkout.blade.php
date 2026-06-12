<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - {{ config('app.name', 'Encanto Pet') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="{{ asset('css/i18n.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/i18n/translations.js') }}"></script>
    <script src="{{ asset('js/i18n/i18n.js') }}"></script>
    <style>
        .checkout-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(23, 25, 40, 0.52);
        }

        .checkout-modal-overlay.is-open {
            display: flex;
        }

        .checkout-success-modal {
            width: min(390px, 100%);
            border-radius: 18px;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 20px 54px rgba(23, 25, 40, 0.24);
            text-align: center;
        }

        .checkout-success-badge {
            width: 58px;
            height: 58px;
            margin: 0 auto 16px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #263245;
            background: var(--yellow);
            font-size: 1.8rem;
        }

        .checkout-success-modal h2 {
            color: var(--text);
            font-size: 1.28rem;
            font-weight: 900;
            line-height: 1.2;
        }

        .checkout-success-modal p {
            margin-top: 10px;
            color: var(--muted);
            font-weight: 800;
            line-height: 1.55;
        }

        .checkout-success-actions {
            margin-top: 22px;
            display: grid;
            gap: 10px;
        }

        .checkout-success-actions a,
        .checkout-success-actions button {
            min-height: 43px;
            border: 0;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #263245;
            background: var(--yellow);
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
        }

        .checkout-success-actions button {
            color: var(--blue);
            background: #eef9fc;
        }

        .checkout-step.is-hidden {
            display: none;
        }

        .checkout-address-body {
            position: relative;
            min-height: 560px;
            padding: 58px clamp(18px, 5vw, 70px);
            display: grid;
            grid-template-columns: minmax(280px, 1fr) minmax(280px, 390px);
            gap: clamp(34px, 8vw, 90px);
            overflow: hidden;
            background: #ffffff;
        }

        .checkout-map {
            width: min(100%, 430px);
            min-height: 260px;
            margin-top: 44px;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(90deg, transparent 0 48%, rgba(255, 255, 255, 0.72) 48% 52%, transparent 52%),
                linear-gradient(0deg, transparent 0 45%, rgba(255, 255, 255, 0.72) 45% 50%, transparent 50%),
                repeating-linear-gradient(35deg, #e6edf0 0 16px, #d9e5e9 16px 20px, #edf4f6 20px 42px);
            box-shadow: var(--shadow);
        }

        .checkout-map::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(130deg, transparent 0 38%, rgba(95, 181, 119, 0.36) 38% 44%, transparent 44%),
                linear-gradient(25deg, transparent 0 58%, rgba(82, 155, 213, 0.28) 58% 63%, transparent 63%);
        }

        .checkout-map::after {
            content: "";
            position: absolute;
            left: 58%;
            top: 37%;
            width: 20px;
            height: 20px;
            border-radius: 50% 50% 50% 0;
            background: #e53935;
            transform: rotate(-45deg);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.22);
        }

        .checkout-address-note {
            margin-top: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 0.88rem;
            font-weight: 800;
        }

        .checkout-address-note i {
            color: var(--yellow-dark);
            font-size: 1.8rem;
        }

        .address-form {
            display: grid;
            gap: 16px;
            align-content: start;
            padding-top: 48px;
        }

        .address-field {
            position: relative;
        }

        .address-field label {
            position: absolute;
            left: 0;
            top: -11px;
            z-index: 2;
            border-radius: 5px;
            padding: 2px 9px;
            color: #5f6d7d;
            background: #dfeaf2;
            font-size: 0.76rem;
            font-weight: 900;
        }

        .address-field input {
            width: 100%;
            min-height: 54px;
            border: 0;
            border-radius: 9px;
            padding: 15px 16px;
            color: var(--text);
            background: #edf4fb;
            box-shadow: 0 8px 16px rgba(31, 74, 104, 0.14);
            outline: none;
            font-weight: 800;
        }

        .address-field input:focus {
            box-shadow: 0 0 0 3px rgba(255, 211, 31, 0.35), 0 8px 16px rgba(31, 74, 104, 0.14);
            background: #ffffff;
        }

        .address-submit {
            width: min(100%, 230px);
            min-height: 54px;
            margin: 6px auto 0;
            border: 0;
            border-radius: 13px;
            color: #ffffff;
            background: var(--yellow-dark);
            font-size: 1.05rem;
            font-weight: 900;
            cursor: pointer;
        }

        .pay-modal {
            display: none;
        }

        .pay-modal.is-open {
            display: block;
        }

        .modal-close {
            position: absolute;
            right: 18px;
            top: 14px;
            border: 0;
            color: var(--muted);
            background: transparent;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .payment-card-preview {
            min-height: 150px;
            border-radius: 18px;
            padding: 20px;
            display: grid;
            align-content: space-between;
            color: #263245;
            background: linear-gradient(135deg, #ffd31f, #ffe984);
            font-weight: 900;
            text-align: left;
        }

        .payment-card-preview.debit {
            color: #ffffff;
            background: linear-gradient(135deg, #1f8fcf, #65c9d7);
        }

        .payment-form-fields {
            margin-top: 18px;
            display: grid;
            gap: 10px;
        }

        .payment-form-fields input {
            width: 100%;
            min-height: 42px;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 10px 12px;
            outline: none;
            font-weight: 800;
        }

        .pix-box {
            width: 170px;
            height: 170px;
            margin: 18px auto;
            border: 10px solid #ffffff;
            border-radius: 10px;
            background:
                linear-gradient(90deg, #222 10px, transparent 10px 30px, #222 30px 46px, transparent 46px),
                linear-gradient(#222 10px, transparent 10px 30px, #222 30px 46px, transparent 46px),
                repeating-linear-gradient(45deg, #222 0 8px, #ffffff 8px 16px);
            box-shadow: var(--shadow);
        }

        @media (max-width: 980px) {
            .checkout-address-body {
                grid-template-columns: 1fr;
            }

            .address-form {
                padding-top: 10px;
            }
        }
    </style>
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
                <a href="/#produtos"    data-i18n="nav.products">Produtos</a>
                <a href="/#categorias"  data-i18n="nav.dogs">Cachorros</a>
                <a href="/#categorias"  data-i18n="nav.cats">Gatos</a>
                <a href="/#ofertas"     data-i18n="nav.promotions">Promoções</a>
                <a href="#"             data-i18n="nav.adopt">Adote aqui!</a>
                <a href="#footer"       data-i18n="nav.contact">Nosso contato</a>
            </nav>

            <div class="nav-right">
                <form class="search" role="search">
                    <input type="search" name="search"
                        data-i18n-placeholder="nav.search_placeholder"
                        placeholder="Pesquise produtos..."
                        autocomplete="off">
                    <button type="submit" data-i18n-aria="nav.search_label" aria-label="Pesquisar">
                        <img src="{{ asset('assets/icon/lupa.svg') }}" alt="">
                    </button>
                </form>

                @auth
                    <div class="home-auth-links">
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" data-i18n="nav.dashboard">Dashboard</a>
                    </div>
                @endauth

                <div class="icons">
                    <a href="#" data-i18n-aria="nav.notification" aria-label="Notificação"><i class="ph ph-bell"></i></a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" data-i18n-aria="nav.dashboard" aria-label="Dashboard"><i class="ph ph-user"></i></a>
                        @else
                            <a href="{{ route('login') }}" aria-label="Login"><i class="ph ph-user"></i></a>
                        @endauth
                    @endif

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

                    <a class="cart-icon" href="{{ route('checkout') }}" data-i18n-aria="nav.cart" aria-label="Carrinho">
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
        <section class="checkout-body checkout-step" id="payment-step">
            <span class="bone-deco" aria-hidden="true">🦴</span>

            <div class="checkout-left">
                <h1 class="checkout-page-title" data-i18n="checkout.title">Seu pet autorizou esse pagamento :)</h1>
                <p class="checkout-page-sub" data-i18n="checkout.subtitle">Selecione o método de pagamento</p>

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
                            <strong data-i18n="checkout.empty">Seu carrinho está vazio.</strong>
                            <a href="/#produtos" data-i18n="checkout.choose_products">Escolher produtos</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <aside class="checkout-right">
                <div class="order-summary">
                    <div class="summary-row">
                        <span class="summary-label" data-i18n="checkout.subtotal">Subtotal:</span>
                        <span
                            class="summary-value"
                            id="checkout-subtotal"
                            data-fallback="R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}"
                        >R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label" data-i18n="checkout.fees">Taxas</span>
                        <span class="summary-free" data-i18n="checkout.free_shipping">Frete Grátis</span>
                    </div>
                    <hr>
                    <div class="summary-row summary-total">
                        <span class="summary-label" data-i18n="checkout.total">Total:</span>
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
                        <span data-i18n="checkout.credit_card">Cartão de crédito</span>
                    </button>
                    <button class="payment-option" type="button" onclick="selectPayment(this)">
                        <span class="radio-circle"></span>
                        <span data-i18n="checkout.debit_card">Cartão de débito</span>
                    </button>
                    <button class="payment-option" type="button" onclick="selectPayment(this)">
                        <span class="radio-circle"></span>
                        <span data-i18n="checkout.pix">Pix</span>
                    </button>
                </div>

                <button class="btn-checkout" type="button" onclick="finishCheckout()" data-i18n="checkout.finish">Finalizar pagamento!</button>
            </aside>

            <div class="checkout-pet-deco" aria-hidden="true"><img src="{{ asset('assets/img/gato-pagamento.svg') }}" alt=""></div>
            <div class="checkout-paw-deco" aria-hidden="true">🐾 🐾</div>
        </section>

        <div class="checkout-back">
            <a href="/#produtos" data-i18n="checkout.back_products">← Voltar aos produtos</a>
        </div>

        <section class="checkout-address-body checkout-step is-hidden" id="address-step">
            <div class="checkout-left">
                <h1 class="checkout-page-title" data-i18n="checkout.address_title">Insira o endereço para entrega do pacote!</h1>
                <p class="checkout-page-sub" data-i18n="checkout.address_sub">A felicidade do seu pet chega em até 12 dias :)</p>

                <div class="checkout-map" aria-hidden="true"></div>

                <div class="checkout-address-note">
                    <i class="ph ph-map-pin"></i>
                    <span id="address-preview" data-i18n="checkout.address_placeholder">Endereço cadastrado: preencha os dados para entrega.</span>
                </div>
            </div>

            <form class="address-form" id="delivery-address-form">
                <div class="address-field">
                    <label for="delivery-street" data-i18n="checkout.street">Rua</label>
                    <input id="delivery-street" name="street" type="text" autocomplete="street-address" required>
                </div>
                <div class="address-field">
                    <label for="delivery-zip" data-i18n="checkout.zip">CEP</label>
                    <input id="delivery-zip" name="zip" type="text" autocomplete="postal-code" required>
                </div>
                <div class="address-field">
                    <label for="delivery-city" data-i18n="checkout.city">Cidade</label>
                    <input id="delivery-city" name="city" type="text" autocomplete="address-level2" required>
                </div>
                <div class="address-field">
                    <label for="delivery-number" data-i18n="checkout.number">Número</label>
                    <input id="delivery-number" name="number" type="text" required>
                </div>
                <div class="address-field">
                    <label for="delivery-complement" data-i18n="checkout.complement">Complemento</label>
                    <input id="delivery-complement" name="complement" type="text">
                </div>

                <button class="address-submit" type="submit" data-i18n="checkout.finish_purchase">Finalizar a compra</button>
            </form>
        </section>
    </main>

    <footer id="footer">
        <div>
            <h4>🐾 Encanto Pet</h4>
            <p data-i18n="footer.checkout_tagline">Obrigado pela visita. Seu pet provavelmente já está escolhendo a próxima compra.</p>
        </div>
        <div>
            <h4 data-i18n="footer.checkout_adopt">Adote Aqui</h4>
            <ul>
                <li data-i18n="footer.dogs">Cachorros</li>
                <li data-i18n="footer.cats">Gatos</li>
                <li data-i18n="footer.birds">Pássaros</li>
            </ul>
        </div>
        <div>
            <h4 data-i18n="footer.checkout_contacts">Contatos</h4>
            <ul>
                <li>contato@encantopet.com</li>
                <li>(11) 99999-9999</li>
            </ul>
        </div>
        <div>
            <h4 data-i18n="footer.checkout_address_label">Endereço</h4>
            <ul>
                <li>São Paulo, SP</li>
                <li>Encanto Pet</li>
            </ul>
        </div>
    </footer>
    <div class="footer-bottom" data-i18n="footer.checkout_copyright">© 2026 Encanto Pet</div>

    <div id="toast"></div>

    {{-- ── Modais de pagamento ── --}}
    <div class="checkout-modal-overlay" id="payment-modal-overlay" aria-hidden="true">
        <div class="checkout-success-modal pay-modal" id="modal-credit" role="dialog" aria-modal="true" aria-labelledby="modal-credit-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-credit-title" data-i18n="checkout.credit_modal_title">Cadastre o seu cartão de crédito</h2>
            <div class="payment-card-preview">
                <span>mastercard</span>
                <strong id="credit-card-preview">•••• •••• •••• ••••</strong>
                <span>Credit Card</span>
            </div>
            <div class="payment-form-fields">
                <input type="text" maxlength="19" data-i18n-placeholder="checkout.card_number" placeholder="Número do cartão" data-card-input data-card-target="credit-card-preview">
                <input type="text" maxlength="3"  data-i18n-placeholder="checkout.cvc"         placeholder="CVC">
                <input type="text" maxlength="5"  data-i18n-placeholder="checkout.expiry"      placeholder="MM/AA">
                <input type="text"                data-i18n-placeholder="checkout.card_name"    placeholder="Nome registrado no cartão">
            </div>
            <button class="btn-checkout" type="button" data-confirm-payment data-i18n="checkout.confirm_payment">Confirmar pagamento</button>
        </div>

        <div class="checkout-success-modal pay-modal" id="modal-debit" role="dialog" aria-modal="true" aria-labelledby="modal-debit-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-debit-title" data-i18n="checkout.debit_modal_title">Cadastre o seu cartão de débito</h2>
            <div class="payment-card-preview debit">
                <span>mastercard</span>
                <strong id="debit-card-preview">•••• •••• •••• ••••</strong>
                <span>Debit Card</span>
            </div>
            <div class="payment-form-fields">
                <input type="text" maxlength="19" data-i18n-placeholder="checkout.card_number" placeholder="Número do cartão" data-card-input data-card-target="debit-card-preview">
                <input type="text" maxlength="3"  data-i18n-placeholder="checkout.cvc"         placeholder="CVC">
                <input type="text" maxlength="5"  data-i18n-placeholder="checkout.expiry"      placeholder="MM/AA">
                <input type="text"                data-i18n-placeholder="checkout.card_name"    placeholder="Nome registrado no cartão">
            </div>
            <button class="btn-checkout" type="button" data-confirm-payment data-i18n="checkout.confirm_payment">Confirmar pagamento</button>
        </div>

        <div class="checkout-success-modal pay-modal" id="modal-pix" role="dialog" aria-modal="true" aria-labelledby="modal-pix-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-pix-title" data-i18n="checkout.pix_modal_title">Aponte sua câmera para escanear o QR Code</h2>
            <div class="pix-box" aria-hidden="true"></div>
            <p data-i18n="checkout.pix_desc">O pagamento cai na hora e a compra é validada instantaneamente.</p>
            <button class="btn-checkout" type="button" data-confirm-payment data-i18n="checkout.confirm_pix">Confirmar Pix</button>
        </div>
    </div>

    {{-- ── Modal de sucesso ── --}}
    <div class="checkout-modal-overlay" id="checkout-success-overlay" aria-hidden="true">
        <div class="checkout-success-modal" role="dialog" aria-modal="true" aria-labelledby="checkout-success-title">
            <div class="checkout-success-badge" aria-hidden="true"><i class="ph ph-check"></i></div>
            <h2 id="checkout-success-title" data-i18n="checkout.success_title">Pedido criado com sucesso!</h2>
            <p data-i18n="checkout.success_desc">Obrigada por confiar no nosso trabalho. Agora você já pode acompanhar o andamento do pedido.</p>
            <div class="checkout-success-actions">
                <a href="{{ route('orders.index') }}" data-i18n="checkout.track_order">Acompanhar meu pedido</a>
                <button type="button" id="checkout-continue-shopping" data-i18n="checkout.continue_shopping">Continuar comprando</button>
            </div>
        </div>
    </div>

    <script type="module">
        const cartStorageKey = 'encantoPetCart';
        const checkoutItems  = document.getElementById('checkout-items');
        const subtotalEl     = document.getElementById('checkout-subtotal');
        const totalEl        = document.getElementById('checkout-total');
        const paymentStep    = document.getElementById('payment-step');
        const addressStep    = document.getElementById('address-step');
        const paymentOverlay = document.getElementById('payment-modal-overlay');
        const successOverlay = document.getElementById('checkout-success-overlay');
        const continueBtn    = document.getElementById('checkout-continue-shopping');
        const addressForm    = document.getElementById('delivery-address-form');
        const addressPreview = document.getElementById('address-preview');
        const csrfToken      = document.querySelector('meta[name="csrf-token"]')?.content;
        const createOrderUrl = @json(route('orders.store'));
        const ordersUrl      = @json(route('orders.index'));
        const loginUrl       = @json(route('login'));
        const canCreateOrder = @json(auth()->check());
        let selectedPaymentMethod = 'credit';

        const _t = (key) => window.i18n?.t(key) || key;

        function readCart()        { try { return JSON.parse(localStorage.getItem(cartStorageKey)) || []; } catch { return []; } }
        function writeCart(cart)   { localStorage.setItem(cartStorageKey, JSON.stringify(cart)); }
        function formatCurrency(v) { return Number(v || 0).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }); }
        function escHtml(v)        { return String(v || '').replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'",'&#039;'); }

        function updateCartCount() {
            const c = document.getElementById('cart-count');
            if (c) c.textContent = readCart().length;
        }

        function renderCart() {
            if (!checkoutItems || !subtotalEl || !totalEl) return;
            const cart = readCart();

            if (!cart.length) {
                checkoutItems.innerHTML = `
                    <div class="checkout-empty">
                        <strong>${_t('checkout.empty')}</strong>
                        <a href="/#produtos">${_t('checkout.choose_products')}</a>
                    </div>`;
                subtotalEl.textContent = 'R$ 0,00';
                totalEl.textContent    = 'R$ 0,00';
                return;
            }

            checkoutItems.innerHTML = cart.map((item) => `
                <div class="order-item">
                    <div class="order-item-img">
                        ${item.image ? `<img src="${escHtml(item.image)}" alt="${escHtml(item.name)}">` : '<span>&#128062;</span>'}
                    </div>
                    <div class="order-item-text">
                        <div class="order-item-name">${escHtml(item.name)}</div>
                        <div class="order-item-desc">${escHtml(item.description || _t('checkout.product_default'))}</div>
                        <div class="order-item-price">${formatCurrency(item.price)}</div>
                    </div>
                </div>`).join('');

            const subtotal = cart.reduce((s, i) => s + Number(i.price || 0), 0);
            subtotalEl.textContent = formatCurrency(subtotal);
            totalEl.textContent    = formatCurrency(subtotal);
        }

        function closePaymentModal() {
            paymentOverlay.classList.remove('is-open');
            paymentOverlay.setAttribute('aria-hidden', 'true');
            document.querySelectorAll('.pay-modal').forEach((m) => m.classList.remove('is-open'));
        }

        function openPaymentModal() {
            const id = { credit: 'modal-credit', debit: 'modal-debit', pix: 'modal-pix' }[selectedPaymentMethod] || 'modal-credit';
            document.querySelectorAll('.pay-modal').forEach((m) => m.classList.remove('is-open'));
            document.getElementById(id)?.classList.add('is-open');
            paymentOverlay.classList.add('is-open');
            paymentOverlay.setAttribute('aria-hidden', 'false');
        }

        function showAddressStep() {
            closePaymentModal();
            paymentStep.classList.add('is-hidden');
            addressStep.classList.remove('is-hidden');
            addressStep.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function showSuccessModal() {
            successOverlay.classList.add('is-open');
            successOverlay.setAttribute('aria-hidden', 'false');
        }

        window.selectPayment = function (option) {
            document.querySelectorAll('.payment-option .radio-circle').forEach((c) => { c.classList.remove('selected'); c.innerHTML = ''; });
            const circle = option.querySelector('.radio-circle');
            circle.classList.add('selected');
            circle.innerHTML = '<div class="radio-dot"></div>';
            const label = option.textContent.toLowerCase();
            selectedPaymentMethod = label.includes('débito') || label.includes('debito') ? 'debit' : (label.includes('pix') ? 'pix' : 'credit');
        };

        window.finishCheckout = function () {
            if (!readCart().length) { window.showToast?.(_t('checkout.toast_add_item')); return; }
            openPaymentModal();
        };

        document.querySelectorAll('[data-close-payment]').forEach((b) => b.addEventListener('click', closePaymentModal));
        document.querySelectorAll('[data-confirm-payment]').forEach((b) => b.addEventListener('click', showAddressStep));

        document.querySelectorAll('[data-card-input]').forEach((input) => {
            input.addEventListener('input', () => {
                const val = input.value.replace(/\D/g, '').slice(0, 16);
                input.value = val.replace(/(.{4})/g, '$1 ').trim();
                const preview = document.getElementById(input.dataset.cardTarget);
                if (preview) preview.textContent = input.value || '•••• •••• •••• ••••';
            });
        });

        paymentOverlay.addEventListener('click', (e) => { if (e.target === paymentOverlay) closePaymentModal(); });

        addressForm.addEventListener('input', () => {
            const d = new FormData(addressForm);
            const street = d.get('street') || 'Rua';
            const number = d.get('number') || 'Nº';
            const city   = d.get('city')   || 'Cidade';
            const zip    = d.get('zip')    || 'CEP';
            addressPreview.textContent = `${_t('checkout.address_prefix')} ${street}, ${number} - ${city} - ${zip}`;
        });

        addressForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const cart = readCart();
            if (!cart.length) { window.showToast?.(_t('checkout.toast_empty_cart')); return; }
            if (!canCreateOrder) { window.showToast?.(_t('checkout.toast_login')); window.location.href = loginUrl; return; }

            const d = new FormData(addressForm);
            const submitBtn = addressForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = _t('checkout.processing');

            try {
                const res = await fetch(createOrderUrl, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({
                        payment_method: selectedPaymentMethod,
                        address: { street: d.get('street'), zip: d.get('zip'), city: d.get('city'), number: d.get('number'), complement: d.get('complement') },
                        items: cart.map((i) => ({ id: i.id, quantity: i.quantity || 1 })),
                    }),
                });
                if (!res.ok) throw new Error('order_error');
                const result = await res.json();
                const followLink = successOverlay.querySelector('a');
                followLink.href = result.orders_url || ordersUrl;
                writeCart([]);
                updateCartCount();
                renderCart();
                showSuccessModal();
            } catch {
                window.showToast?.(_t('checkout.toast_order_error'));
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = _t('checkout.finish_purchase');
            }
        });

        successOverlay.addEventListener('click', (e) => {
            if (e.target !== successOverlay) return;
            successOverlay.classList.remove('is-open');
            successOverlay.setAttribute('aria-hidden', 'true');
        });

        continueBtn.addEventListener('click', () => { window.location.href = '/#produtos'; });

        updateCartCount();
        renderCart();
    </script>
</body>
</html>
