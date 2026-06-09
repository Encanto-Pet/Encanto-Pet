<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - {{ config('app.name', 'Encanto Pet') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <a href="/#produtos">Produtos</a>
                <a href="/#categorias">Cachorros</a>
                <a href="/#categorias">Gatos</a>
                <a href="/#ofertas">Promoções</a>
                <a href="#">Adote aqui!</a>
                <a href="#footer">Nosso contato</a>
            </nav>

            <div class="nav-right">
                <form class="search" role="search">
                    <input type="search" name="search" placeholder="Pesquise produtos..." autocomplete="off">
                    <button type="submit" aria-label="Pesquisar">
                        <img src="{{ asset('assets/icon/lupa.svg') }}" alt="">
                    </button>
                </form>

                @auth
                    <div class="home-auth-links">
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>
                    </div>
                @endauth

                <div class="icons">
                    <a href="#" aria-label="Notificação"><i class="ph ph-bell"></i></a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" aria-label="Dashboard"><i class="ph ph-user"></i></a>
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
        <section class="checkout-body checkout-step" id="payment-step">
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

        <section class="checkout-address-body checkout-step is-hidden" id="address-step">
            <div class="checkout-left">
                <h1 class="checkout-page-title">Insira o endere&ccedil;o para entrega do pacote!</h1>
                <p class="checkout-page-sub">A felicidade do seu pet chega em at&eacute; 12 dias :)</p>

                <div class="checkout-map" aria-hidden="true"></div>

                <div class="checkout-address-note">
                    <i class="ph ph-map-pin"></i>
                    <span id="address-preview">Endere&ccedil;o cadastrado: preencha os dados para entrega.</span>
                </div>
            </div>

            <form class="address-form" id="delivery-address-form">
                <div class="address-field">
                    <label for="delivery-street">Rua</label>
                    <input id="delivery-street" name="street" type="text" autocomplete="street-address" required>
                </div>
                <div class="address-field">
                    <label for="delivery-zip">CEP</label>
                    <input id="delivery-zip" name="zip" type="text" autocomplete="postal-code" required>
                </div>
                <div class="address-field">
                    <label for="delivery-city">Cidade</label>
                    <input id="delivery-city" name="city" type="text" autocomplete="address-level2" required>
                </div>
                <div class="address-field">
                    <label for="delivery-number">N&uacute;mero</label>
                    <input id="delivery-number" name="number" type="text" required>
                </div>
                <div class="address-field">
                    <label for="delivery-complement">Complemento</label>
                    <input id="delivery-complement" name="complement" type="text">
                </div>

                <button class="address-submit" type="submit">Finalizar a compra</button>
            </form>
        </section>
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

    <div class="checkout-modal-overlay" id="payment-modal-overlay" aria-hidden="true">
        <div class="checkout-success-modal pay-modal" id="modal-credit" role="dialog" aria-modal="true" aria-labelledby="modal-credit-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-credit-title">Cadastre o seu cart&atilde;o de cr&eacute;dito</h2>
            <div class="payment-card-preview">
                <span>mastercard</span>
                <strong id="credit-card-preview">•••• •••• •••• ••••</strong>
                <span>Credit Card</span>
            </div>
            <div class="payment-form-fields">
                <input type="text" maxlength="19" placeholder="N&uacute;mero do cart&atilde;o" data-card-input data-card-target="credit-card-preview">
                <input type="text" maxlength="3" placeholder="CVC">
                <input type="text" maxlength="5" placeholder="MM/AA">
                <input type="text" placeholder="Nome registrado no cart&atilde;o">
            </div>
            <button class="btn-checkout" type="button" data-confirm-payment>Confirmar pagamento</button>
        </div>

        <div class="checkout-success-modal pay-modal" id="modal-debit" role="dialog" aria-modal="true" aria-labelledby="modal-debit-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-debit-title">Cadastre o seu cart&atilde;o de d&eacute;bito</h2>
            <div class="payment-card-preview debit">
                <span>mastercard</span>
                <strong id="debit-card-preview">•••• •••• •••• ••••</strong>
                <span>Debit Card</span>
            </div>
            <div class="payment-form-fields">
                <input type="text" maxlength="19" placeholder="N&uacute;mero do cart&atilde;o" data-card-input data-card-target="debit-card-preview">
                <input type="text" maxlength="3" placeholder="CVC">
                <input type="text" maxlength="5" placeholder="MM/AA">
                <input type="text" placeholder="Nome registrado no cart&atilde;o">
            </div>
            <button class="btn-checkout" type="button" data-confirm-payment>Confirmar pagamento</button>
        </div>

        <div class="checkout-success-modal pay-modal" id="modal-pix" role="dialog" aria-modal="true" aria-labelledby="modal-pix-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-pix-title">Aponte sua c&acirc;mera para escanear o QR Code</h2>
            <div class="pix-box" aria-hidden="true"></div>
            <p>O pagamento cai na hora e a compra &eacute; validada instantaneamente.</p>
            <button class="btn-checkout" type="button" data-confirm-payment>Confirmar Pix</button>
        </div>
    </div>

    <div class="checkout-modal-overlay" id="checkout-success-overlay" aria-hidden="true">
        <div class="checkout-success-modal" role="dialog" aria-modal="true" aria-labelledby="checkout-success-title">
            <div class="checkout-success-badge" aria-hidden="true"><i class="ph ph-check"></i></div>
            <h2 id="checkout-success-title">Pedido criado com sucesso!</h2>
            <p>Obrigada por confiar no nosso trabalho. Agora voc&ecirc; j&aacute; pode acompanhar o andamento do pedido.</p>
            <div class="checkout-success-actions">
                <a href="{{ route('orders.index') }}">Acompanhar meu pedido</a>
                <button type="button" id="checkout-continue-shopping">Continuar comprando</button>
            </div>
        </div>
    </div>

    <script type="module">
        const cartStorageKey = 'encantoPetCart';
        const checkoutItems = document.getElementById('checkout-items');
        const subtotalElement = document.getElementById('checkout-subtotal');
        const totalElement = document.getElementById('checkout-total');
        const paymentStep = document.getElementById('payment-step');
        const addressStep = document.getElementById('address-step');
        const paymentOverlay = document.getElementById('payment-modal-overlay');
        const successOverlay = document.getElementById('checkout-success-overlay');
        const continueShoppingButton = document.getElementById('checkout-continue-shopping');
        const addressForm = document.getElementById('delivery-address-form');
        const addressPreview = document.getElementById('address-preview');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const createOrderUrl = @json(route('orders.store'));
        const ordersUrl = @json(route('orders.index'));
        const loginUrl = @json(route('login'));
        const canCreateOrder = @json(auth()->check());
        let selectedPaymentMethod = 'credit';

        function readCheckoutCart() {
            try {
                return JSON.parse(localStorage.getItem(cartStorageKey)) || [];
            } catch {
                return [];
            }
        }

        function writeCheckoutCart(cart) {
            localStorage.setItem(cartStorageKey, JSON.stringify(cart));
        }

        function formatCheckoutCurrency(value) {
            return Number(value || 0).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL',
            });
        }

        function escapeCheckoutHtml(value) {
            return String(value || '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function updateCheckoutCartCount() {
            const counter = document.getElementById('cart-count');
            if (counter) counter.textContent = readCheckoutCart().length;
        }

        function renderCheckoutCartFromStorage() {
            if (!checkoutItems || !subtotalElement || !totalElement) return;

            const cart = readCheckoutCart();

            if (!cart.length) {
                checkoutItems.innerHTML = `
                    <div class="checkout-empty">
                        <strong>Seu carrinho est&aacute; vazio.</strong>
                        <a href="/#produtos">Escolher produtos</a>
                    </div>
                `;
                subtotalElement.textContent = 'R$ 0,00';
                totalElement.textContent = 'R$ 0,00';
                return;
            }

            checkoutItems.innerHTML = cart.map((item) => `
                <div class="order-item">
                    <div class="order-item-img">
                        ${item.image ? `<img src="${escapeCheckoutHtml(item.image)}" alt="${escapeCheckoutHtml(item.name)}">` : '<span>&#128062;</span>'}
                    </div>
                    <div class="order-item-text">
                        <div class="order-item-name">${escapeCheckoutHtml(item.name)}</div>
                        <div class="order-item-desc">${escapeCheckoutHtml(item.description || 'Produto Encanto Pet')}</div>
                        <div class="order-item-price">${formatCheckoutCurrency(item.price)}</div>
                    </div>
                </div>
            `).join('');

            const subtotal = cart.reduce((sum, item) => sum + Number(item.price || 0), 0);
            subtotalElement.textContent = formatCheckoutCurrency(subtotal);
            totalElement.textContent = formatCheckoutCurrency(subtotal);
        }

        function closePaymentModal() {
            paymentOverlay.classList.remove('is-open');
            paymentOverlay.setAttribute('aria-hidden', 'true');
            document.querySelectorAll('.pay-modal').forEach((modal) => modal.classList.remove('is-open'));
        }

        function openPaymentModal() {
            const modalId = {
                credit: 'modal-credit',
                debit: 'modal-debit',
                pix: 'modal-pix',
            }[selectedPaymentMethod] || 'modal-credit';

            document.querySelectorAll('.pay-modal').forEach((modal) => modal.classList.remove('is-open'));
            document.getElementById(modalId)?.classList.add('is-open');
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

        function selectedPaymentLabel(option) {
            return option.textContent.toLowerCase();
        }

        window.selectPayment = function selectPayment(option) {
            document.querySelectorAll('.payment-option .radio-circle').forEach((circle) => {
                circle.classList.remove('selected');
                circle.innerHTML = '';
            });

            const selectedCircle = option.querySelector('.radio-circle');
            selectedCircle.classList.add('selected');
            selectedCircle.innerHTML = '<div class="radio-dot"></div>';

            const label = selectedPaymentLabel(option);
            selectedPaymentMethod = label.includes('débito') || label.includes('debito')
                ? 'debit'
                : (label.includes('pix') ? 'pix' : 'credit');
        };

        window.finishCheckout = function finishCheckout() {
            const cart = readCheckoutCart();

            if (!cart.length) {
                window.showToast?.('Adicione um produto ao carrinho antes de finalizar.');
                return;
            }

            openPaymentModal();
        };

        document.querySelectorAll('[data-close-payment]').forEach((button) => {
            button.addEventListener('click', closePaymentModal);
        });

        document.querySelectorAll('[data-confirm-payment]').forEach((button) => {
            button.addEventListener('click', showAddressStep);
        });

        document.querySelectorAll('[data-card-input]').forEach((input) => {
            input.addEventListener('input', () => {
                const value = input.value.replace(/\D/g, '').slice(0, 16);
                input.value = value.replace(/(.{4})/g, '$1 ').trim();
                const preview = document.getElementById(input.dataset.cardTarget);
                if (preview) preview.textContent = input.value || '•••• •••• •••• ••••';
            });
        });

        paymentOverlay.addEventListener('click', (event) => {
            if (event.target === paymentOverlay) closePaymentModal();
        });

        addressForm.addEventListener('input', () => {
            const data = new FormData(addressForm);
            const street = data.get('street') || 'Rua';
            const number = data.get('number') || 'Nº';
            const city = data.get('city') || 'Cidade';
            const zip = data.get('zip') || 'CEP';
            addressPreview.textContent = `Endereço cadastrado: ${street}, ${number} - ${city} - ${zip}`;
        });

        addressForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const cart = readCheckoutCart();
            if (!cart.length) {
                window.showToast?.('Seu carrinho está vazio.');
                return;
            }

            if (!canCreateOrder) {
                window.showToast?.('Entre na sua conta para salvar o pedido em Meus pedidos.');
                window.location.href = loginUrl;
                return;
            }

            const data = new FormData(addressForm);
            const submitButton = addressForm.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Finalizando...';

            try {
                const response = await fetch(createOrderUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        payment_method: selectedPaymentMethod,
                        address: {
                            street: data.get('street'),
                            zip: data.get('zip'),
                            city: data.get('city'),
                            number: data.get('number'),
                            complement: data.get('complement'),
                        },
                        items: cart.map((item) => ({
                            id: item.id,
                            quantity: item.quantity || 1,
                        })),
                    }),
                });

                if (!response.ok) throw new Error('order_error');

                const result = await response.json();
                const followLink = successOverlay.querySelector('a');
                followLink.href = result.orders_url || ordersUrl;

                writeCheckoutCart([]);
                updateCheckoutCartCount();
                renderCheckoutCartFromStorage();
                showSuccessModal();
            } catch {
                window.showToast?.('Não foi possível finalizar o pedido. Confira os dados e tente novamente.');
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = 'Finalizar a compra';
            }
        });

        successOverlay.addEventListener('click', (event) => {
            if (event.target !== successOverlay) return;
            successOverlay.classList.remove('is-open');
            successOverlay.setAttribute('aria-hidden', 'true');
        });

        continueShoppingButton.addEventListener('click', () => {
            window.location.href = '/#produtos';
        });

        updateCheckoutCartCount();
        renderCheckoutCartFromStorage();
    </script>
</body>
</html>
