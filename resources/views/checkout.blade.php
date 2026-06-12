<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - {{ config('app.name', 'Encanto Pet') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="{{ asset('css/i18n.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/i18n/translations.js') }}"></script>
    <script src="{{ asset('js/i18n/i18n.js') }}"></script>
    <style>
        :root{
        --branco:#ffffff;
        --preto:#000000;
        --verdeagua:#67A6B0;
        --amarelo:#ECAD14;
        --vermelho:#C50909;
        --cinza:#667085;
        --cinzaclaro:#EAF0F7;
        --cinzamedio:#D6E0EB;
        --amareloclaro:#FFF0CA;
        --verde:#4D9630;
        --degradeamarelo: linear-gradient(to bottom, #FFDC26, #E0AF00);
        --degradeazul: linear-gradient(to bottom, #67A6B0, #267A87);


    }
        /* ── layout ── */
        .checkout-page-public {
            padding-bottom: 80px;
        }

        .checkout-body {
            margin-top: 32px;
            padding: 52px clamp(20px, 5vw, 64px) 60px;
            grid-template-columns: minmax(300px, 1fr) 400px;
            gap: clamp(28px, 6vw, 64px);
            background:
                radial-gradient(circle at 0% 100%, rgba(255, 211, 31, 0.18) 0 28px, transparent 29px),
                linear-gradient(160deg, #f8fafc 0 54%, #fffdf0 54%);
            border-radius: 28px;
            overflow: hidden;
            min-height: auto;
        }

        /* ── left ── */
        .checkout-page-title {
            font-size: clamp(1.8rem, 3.2vw, 2.5rem);
            line-height: 1.1;
            font-weight: 900;
            color: var(--amarelo);
        }

        .checkout-page-sub {
            margin-top: 8px;
            color: #64748b;
            font-size: .96rem;
            font-weight: 700;
        }

        .order-items {
            margin-top: 28px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .order-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 16px;
            border-radius: 18px;
            padding: 14px 56px 14px 14px;
            background: #ffffff;
            box-shadow: 0 2px 14px rgba(26, 43, 70, .07);
            border: 1px solid #edf2f7;
            transition: box-shadow .2s, transform .15s;
        }

        .order-item:hover {
            box-shadow: 0 6px 24px rgba(26, 43, 70, .11);
            transform: translateY(-1px);
        }

        .order-item-img {
            width: 80px;
            height: 80px;
            border-radius: 14px;
            background: #f0f6ff;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .order-item-img img {
            max-width: 90%;
            max-height: 72px;
            object-fit: contain;
        }

        .order-item-img span { font-size: 2.2rem; }

        .order-item-name {
            font-weight: 900;
            color: #0f1728;
            font-size: .97rem;
        }

        .order-item-desc {
            font-size: .82rem;
            color: #6b7a8d;
            margin-top: 3px;
            line-height: 1.4;
        }

        .order-item-price {
            margin-top: 8px;
            font-weight: 900;
            color: #1f8fcf;
            font-size: 1.02rem;
        }

        .cart-remove-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #d84646;
            background: #fff0f1;
            cursor: pointer;
            transition: background .15s, transform .2s;
        }

        .cart-remove-btn:hover {
            background: #ffdee0;
            transform: translateY(-50%) scale(1.1);
        }

        .checkout-empty {
            border: 2px dashed #e2e8f0;
            border-radius: 18px;
            padding: 48px 32px;
            text-align: center;
            background: #f8fafc;
            display: grid;
            gap: 14px;
            place-items: center;
        }

        .checkout-empty strong {
            font-size: 1.05rem;
            color: #334155;
            font-weight: 900;
        }

        .checkout-empty a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 11px 26px;
            border-radius: 999px;
            background: #1f8fcf;
            color: #fff;
            font-weight: 900;
            text-decoration: none;
            font-size: .9rem;
            transition: background .15s, transform .15s;
        }

        .checkout-empty a:hover {
            background: #1779b0;
            transform: translateY(-1px);
        }

        /* ── right column ── */
        .checkout-right {
            position: sticky;
            top: 90px;
            align-self: start;
        }

        .order-summary {
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(26, 43, 70, .13);
            background: #ffffff;
            padding: 0;
        }

        /* summary header — total em destaque */
        .summary-top {
            background: linear-gradient(135deg, #ffd31f 0%, #ffe567 100%);
            padding: 26px 28px 22px;
        }

        .summary-top-label {
            font-size: .76rem;
            font-weight: 900;
            color: #7a5c00;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .summary-top-amount {
            font-size: 2.8rem;
            font-weight: 900;
            color: #1a2b3a;
            line-height: 1;
            margin-top: 4px;
        }

        .summary-top-shipping {
            margin-top: 8px;
            font-size: .82rem;
            font-weight: 800;
            color: #5a7a00;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* rows */
        .summary-rows {
            padding: 16px 28px 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 9px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .summary-row:last-child { border-bottom: 0; }

        .summary-label {
            color: #64748b;
            font-size: .88rem;
            font-weight: 800;
        }

        .summary-value {
            color: #1e293b;
            font-weight: 900;
        }

        .summary-free {
            color: #16a34a;
            font-weight: 900;
            font-size: .88rem;
        }

        .summary-total .summary-label { color: #1e293b; font-weight: 900; }
        .summary-total .summary-value { color: #1f8fcf; font-size: 1.05rem; }

        /* divider */
        .summary-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 0 28px;
        }

        /* payment methods */
        .payment-section {
            padding: 18px 28px 12px;
            display: grid;
            gap: 8px;
        }

        .payment-section-label {
            font-size: .76rem;
            font-weight: 900;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .07em;
            margin-bottom: 4px;
        }

        .payment-option {
            width: 100%;
            border: 2px solid #e8eef6;
            border-radius: 13px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #ffffff;
            color: #1e293b;
            font-weight: 800;
            font-size: .9rem;
            cursor: pointer;
            text-align: left;
            transition: border-color .15s, background .15s, box-shadow .15s;
        }

        .payment-option:hover {
            border-color: #ffd31f;
            background: #fffdf0;
        }

        .payment-option:has(.radio-circle.selected) {
            border-color: #ffd31f;
            background: #fffbe6;
            box-shadow: 0 0 0 1px #ffd31f;
        }

        .payment-icon {
            font-size: 1.25rem;
            flex-shrink: 0;
            width: 28px;
            text-align: center;
        }

        .radio-circle {
            width: 20px;
            height: 20px;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            margin-left: auto;
            background: #fff;
            transition: border-color .15s;
        }

        .radio-circle.selected {
            border-color: #f0b800;
        }

        .radio-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #f0b800;
        }

        /* CTA */
        .btn-checkout {
            display: block;
            width: calc(100% - 56px);
            margin: 8px 28px 28px;
            min-height: 52px;
            border: 0;
            border-radius: 14px;
            color: #1a2b3a;
            background: linear-gradient(90deg, #ffd31f, #ffe567);
            font-size: 1rem;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 6px 22px rgba(240, 184, 0, .3);
            transition: transform .15s, box-shadow .15s;
            letter-spacing: .01em;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(240, 184, 0, .4);
        }

        /* back link */
        .checkout-back {
            padding: 20px 0 10px;
        }

        .checkout-back a {
            color: #64748b;
            font-weight: 800;
            font-size: .88rem;
            text-decoration: none;
            transition: color .15s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .checkout-back a:hover { color: #1f8fcf; }

        /* decorations */
        .bone-deco {
            left: 20px;
            bottom: 40px;
            font-size: 2.6rem;
            opacity: 0.09;
            transform: rotate(-20deg);
        }

        .checkout-pet-deco {
            right: 0;
            bottom: 0;
        }

        .checkout-pet-deco img {
            height: 210px;
            width: auto;
            display: block;
        }

        .checkout-paw-deco {
            right: 22px;
            top: 22px;
            font-size: 1.5rem;
            opacity: 0.12;
        }

        /* ── modais ── */
        .checkout-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(4px);
        }

        .checkout-modal-overlay.is-open { display: flex; }

        .checkout-success-modal {
            width: min(400px, 100%);
            border-radius: 22px;
            padding: 32px 28px;
            background: #ffffff;
            box-shadow: 0 24px 64px rgba(15, 23, 42, .22);
            text-align: center;
            position: relative;
        }

        .checkout-success-badge {
            width: 60px;
            height: 60px;
            margin: 0 auto 18px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #263245;
            background: linear-gradient(135deg, #ffd31f, #ffe567);
            font-size: 1.9rem;
            box-shadow: 0 6px 20px rgba(240, 184, 0, .35);
        }

        .checkout-success-modal h2 {
            color: #0f1728;
            font-size: 1.3rem;
            font-weight: 900;
            line-height: 1.2;
        }

        .checkout-success-modal p {
            margin-top: 10px;
            color: #64748b;
            font-weight: 700;
            line-height: 1.6;
        }

        .checkout-success-actions {
            margin-top: 24px;
            display: grid;
            gap: 10px;
        }

        .checkout-success-actions a {
            min-height: 46px;
            border: 0;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #1a2b3a;
            background: linear-gradient(90deg, #ffd31f, #ffe567);
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(240,184,0,.28);
            transition: transform .15s;
        }

        .checkout-success-actions a:hover { transform: translateY(-1px); }

        .checkout-success-actions button {
            min-height: 46px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #1f8fcf;
            background: #f0f9ff;
            font-weight: 900;
            cursor: pointer;
            transition: background .15s;
        }

        .checkout-success-actions button:hover { background: #e0f2fe; }

        .checkout-step.is-hidden { display: none; }

        .modal-close {
            position: absolute;
            right: 16px;
            top: 14px;
            border: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #94a3b8;
            background: #f1f5f9;
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .modal-close:hover { background: #e2e8f0; color: #334155; }

        .pay-modal { display: none; }
        .pay-modal.is-open { display: block; }

        /* card preview */
        .payment-card-preview {
            min-height: 150px;
            border-radius: 18px;
            padding: 22px;
            display: grid;
            align-content: space-between;
            color: #263245;
            background: linear-gradient(135deg, #ffd31f, #ffe984);
            font-weight: 900;
            text-align: left;
            margin: 18px 0;
            box-shadow: 0 8px 24px rgba(240,184,0,.2);
        }

        .payment-card-preview.debit {
            color: #ffffff;
            background: linear-gradient(135deg, #1f8fcf, #65c9d7);
            box-shadow: 0 8px 24px rgba(31,143,207,.2);
        }

        .payment-form-fields {
            display: grid;
            gap: 10px;
        }

        .payment-form-fields input {
            width: 100%;
            min-height: 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            outline: none;
            font-weight: 700;
            color: #0f1728;
            transition: border-color .15s, box-shadow .15s;
        }

        .payment-form-fields input:focus {
            border-color: #ffd31f;
            box-shadow: 0 0 0 3px rgba(255,211,31,.2);
        }

        /* pix qr */
        .pix-qr-img {
            width: 200px;
            height: 200px;
            margin: 16px auto;
            border-radius: 16px;
            border: 8px solid #f8fafc;
            box-shadow: 0 8px 28px rgba(0,0,0,.12);
            display: block;
        }

        .pix-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 32px 0;
            color: #64748b;
            font-size: .9rem;
            font-weight: 700;
        }

        .pix-spinner {
            width: 36px;
            height: 36px;
            border: 3px solid #e5e7eb;
            border-top-color: #ffd31f;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        .pix-code-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            margin: 8px 0 16px;
        }

        .pix-code {
            flex: 1;
            font-size: .78rem;
            color: #475569;
            font-weight: 700;
            word-break: break-all;
            text-align: left;
            max-height: 52px;
            overflow: hidden;
        }

        .pix-copy-btn {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 8px;
            background: #ffd31f;
            color: #1a2b3a;
            font-size: 1rem;
            cursor: pointer;
            display: grid;
            place-items: center;
            transition: background .15s;
        }

        .pix-copy-btn:hover { background: #f0c400; }
        .pix-copy-btn.copied { background: #16a34a; color: #fff; }

        /* ── address step ── */
        .checkout-address-body {
            position: relative;
            padding: 52px clamp(20px, 5vw, 64px);
            display: grid;
            grid-template-columns: minmax(280px, 1fr) minmax(280px, 390px);
            gap: clamp(32px, 6vw, 72px);
            background: #f8fafc;
            border-radius: 28px;
            margin-top: 32px;
        }

        .checkout-map {
            width: min(100%, 420px);
            min-height: 240px;
            margin-top: 40px;
            border-radius: 14px;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(90deg, transparent 0 48%, rgba(255,255,255,.72) 48% 52%, transparent 52%),
                linear-gradient(0deg, transparent 0 45%, rgba(255,255,255,.72) 45% 50%, transparent 50%),
                repeating-linear-gradient(35deg, #e6edf0 0 16px, #d9e5e9 16px 20px, #edf4f6 20px 42px);
            box-shadow: 0 8px 28px rgba(26,43,70,.1);
        }

        .checkout-map::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(130deg, transparent 0 38%, rgba(95,181,119,.36) 38% 44%, transparent 44%),
                linear-gradient(25deg, transparent 0 58%, rgba(82,155,213,.28) 58% 63%, transparent 63%);
        }

        .checkout-map::after {
            content: "";
            position: absolute;
            left: 58%; top: 37%;
            width: 20px; height: 20px;
            border-radius: 50% 50% 50% 0;
            background: #e53935;
            transform: rotate(-45deg);
            box-shadow: 0 3px 8px rgba(0,0,0,.22);
        }

        .checkout-address-note {
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: .88rem;
            font-weight: 800;
        }

        .checkout-address-note i { color: #f0b800; font-size: 1.6rem; }

        .address-form {
            display: grid;
            gap: 20px;
            align-content: start;
            padding-top: 48px;
        }

        .address-field { position: relative; }

        .address-field label {
            position: absolute;
            left: 12px;
            top: -10px;
            z-index: 2;
            border-radius: 6px;
            padding: 2px 10px;
            color: #5f6d7d;
            background: #dfeaf2;
            font-size: .74rem;
            font-weight: 900;
            letter-spacing: .03em;
        }

        .address-field input {
            width: 100%;
            min-height: 54px;
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 16px;
            color: #0f1728;
            background: #edf4fb;
            outline: none;
            font-weight: 800;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }

        .address-field input:focus {
            border-color: #ffd31f;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(255,211,31,.15);
        }

        .address-submit {
            width: min(100%, 240px);
            min-height: 54px;
            margin: 6px auto 0;
            border: 0;
            border-radius: 14px;
            color: #1a2b3a;
            background: linear-gradient(90deg, #ffd31f, #ffe567);
            font-size: 1rem;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(240,184,0,.28);
            transition: transform .15s, box-shadow .15s;
        }

        .address-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(240,184,0,.38);
        }

        @media (max-width: 980px) {
            .checkout-body,
            .checkout-address-body {
                grid-template-columns: 1fr;
            }
            .checkout-right { position: static; }
            .address-form { padding-top: 10px; }
            .checkout-pet-deco { display: none; }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="/"><img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet"></a>
            </div>
            <nav class="menu">
                <a href="/#produtos"   data-i18n="nav.products">Produtos</a>
                <a href="/#categorias" data-i18n="nav.dogs">Cachorros</a>
                <a href="/#categorias" data-i18n="nav.cats">Gatos</a>
                <a href="/#ofertas"    data-i18n="nav.promotions">Promoções</a>
                <a href="#"            data-i18n="nav.adopt">Adote aqui!</a>
                <a href="#footer"      data-i18n="nav.contact">Nosso contato</a>
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
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" aria-label="Dashboard"><i class="ph ph-user"></i></a>
                        @else
                            <a href="{{ route('login') }}" aria-label="Login"><i class="ph ph-user"></i></a>
                        @endauth
                    @endif
                    <div class="lang-switcher">
                        <button class="lang-btn" onclick="toggleLangMenu(event)" aria-label="Selecionar idioma">
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
                    <a class="cart-icon" href="{{ route('checkout') }}" aria-label="Carrinho">
                        <i class="ph ph-shopping-cart-simple"></i>
                        <span id="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    @php $fallbackSubtotal = $products->sum(fn ($p) => (float) $p->price); @endphp

    <main class="checkout-page-public">
        <section class="checkout-body checkout-step" id="payment-step">
            <span class="bone-deco" aria-hidden="true">🦴</span>

            {{-- ── coluna esquerda: itens ── --}}
            <div class="checkout-left">
                <h1 class="checkout-page-title" data-i18n="checkout.title">
                    Seu pet autorizou esse pagamento 🐾
                </h1>
                <p class="checkout-page-sub" data-i18n="checkout.subtitle">
                    Revise os itens e escolha como pagar
                </p>

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
                            <a href="/#produtos" data-i18n="checkout.choose_products">🛍 Escolher produtos</a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- ── coluna direita: resumo + pagamento ── --}}
            <aside class="checkout-right">
                <div class="order-summary">

                    {{-- total em destaque --}}
                    <div class="summary-top">
                        <div class="summary-top-label">Total do pedido</div>
                        <div class="summary-top-amount"
                             id="checkout-total"
                             data-fallback="R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}">
                            R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}
                        </div>
                        <div class="summary-top-shipping">✓ Frete grátis incluído</div>
                    </div>

                    {{-- linhas de detalhe --}}
                    <div class="summary-rows">
                        <div class="summary-row">
                            <span class="summary-label" data-i18n="checkout.subtotal">Subtotal</span>
                            <span class="summary-value"
                                  id="checkout-subtotal"
                                  data-fallback="R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}">
                                R$ {{ number_format($fallbackSubtotal, 2, ',', '.') }}
                            </span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label" data-i18n="checkout.fees">Frete</span>
                            <span class="summary-free" data-i18n="checkout.free_shipping">Grátis 🎉</span>
                        </div>
                    </div>

                    <div class="summary-divider"></div>

                    {{-- métodos de pagamento --}}
                    <div class="payment-section">
                        <div class="payment-section-label">Forma de pagamento</div>

                        <button class="payment-option" type="button" onclick="selectPayment(this)">
                            <span class="payment-icon">💳</span>
                            <span data-i18n="checkout.credit_card">Cartão de crédito</span>
                            <span class="radio-circle selected"><span class="radio-dot"></span></span>
                        </button>

                        <button class="payment-option" type="button" onclick="selectPayment(this)">
                            <span class="payment-icon">🏦</span>
                            <span data-i18n="checkout.debit_card">Cartão de débito</span>
                            <span class="radio-circle"></span>
                        </button>

                        <button class="payment-option" type="button" onclick="selectPayment(this)">
                            <span class="payment-icon">⚡</span>
                            <span data-i18n="checkout.pix">Pix</span>
                            <span class="radio-circle"></span>
                        </button>
                    </div>

                    <button class="btn-checkout" type="button" onclick="finishCheckout()" data-i18n="checkout.finish">
                        Finalizar pagamento →
                    </button>
                </div>
            </aside>


            <div class="checkout-paw-deco" aria-hidden="true">🐾 🐾</div>
        </section>

        <div class="checkout-back">
            <a href="/#produtos" data-i18n="checkout.back_products">← Voltar aos produtos</a>
        </div>

        {{-- ── step: endereço ── --}}
        <section class="checkout-address-body checkout-step is-hidden" id="address-step">
            <div class="checkout-left">
                <h1 class="checkout-page-title" data-i18n="checkout.address_title">
                    Insira o endereço para entrega 📦
                </h1>
                <p class="checkout-page-sub" data-i18n="checkout.address_sub">
                    A felicidade do seu pet chega em até 12 dias :)
                </p>
                <div class="checkout-map" aria-hidden="true"></div>
                <div class="checkout-address-note">
                    <i class="ph ph-map-pin"></i>
                    <span id="address-preview" data-i18n="checkout.address_placeholder">
                        Preencha os dados para ver o endereço de entrega.
                    </span>
                </div>
            </div>

            <form class="address-form" id="delivery-address-form">
                <div class="address-field">
                    <label for="delivery-street" data-i18n="checkout.street">Rua</label>
                    <input id="delivery-street" name="street" type="text" autocomplete="street-address" required>
                </div>
                <div class="address-field">
                    <label for="delivery-number" data-i18n="checkout.number">Número</label>
                    <input id="delivery-number" name="number" type="text" required>
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
                    <label for="delivery-complement" data-i18n="checkout.complement">Complemento</label>
                    <input id="delivery-complement" name="complement" type="text">
                </div>
                <button class="address-submit" type="submit" data-i18n="checkout.finish_purchase">
                    Finalizar a compra
                </button>
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

    {{-- ── modais de pagamento ── --}}
    <div class="checkout-modal-overlay" id="payment-modal-overlay" aria-hidden="true">
        <div class="checkout-success-modal pay-modal" id="modal-credit" role="dialog" aria-modal="true" aria-labelledby="modal-credit-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-credit-title" data-i18n="checkout.credit_modal_title">Cartão de crédito</h2>
            <div class="payment-card-preview">
                <span style="font-size:.8rem;opacity:.7">mastercard</span>
                <strong id="credit-card-preview" style="font-size:1.3rem;letter-spacing:4px">•••• •••• •••• ••••</strong>
                <span style="font-size:.8rem;opacity:.7">Credit Card</span>
            </div>
            <div class="payment-form-fields">
                <input type="text" maxlength="19" placeholder="Número do cartão" data-i18n-placeholder="checkout.card_number" data-card-input data-card-target="credit-card-preview">
                <input type="text" maxlength="3"  placeholder="CVC" data-i18n-placeholder="checkout.cvc">
                <input type="text" maxlength="5"  placeholder="MM/AA" data-i18n-placeholder="checkout.expiry">
                <input type="text"                placeholder="Nome no cartão" data-i18n-placeholder="checkout.card_name">
            </div>
            <button class="btn-checkout" style="width:100%;margin:18px 0 0" type="button" data-confirm-payment data-i18n="checkout.confirm_payment">Confirmar pagamento</button>
        </div>

        <div class="checkout-success-modal pay-modal" id="modal-debit" role="dialog" aria-modal="true" aria-labelledby="modal-debit-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-debit-title" data-i18n="checkout.debit_modal_title">Cartão de débito</h2>
            <div class="payment-card-preview debit">
                <span style="font-size:.8rem;opacity:.8">mastercard</span>
                <strong id="debit-card-preview" style="font-size:1.3rem;letter-spacing:4px">•••• •••• •••• ••••</strong>
                <span style="font-size:.8rem;opacity:.8">Debit Card</span>
            </div>
            <div class="payment-form-fields">
                <input type="text" maxlength="19" placeholder="Número do cartão" data-i18n-placeholder="checkout.card_number" data-card-input data-card-target="debit-card-preview">
                <input type="text" maxlength="3"  placeholder="CVC" data-i18n-placeholder="checkout.cvc">
                <input type="text" maxlength="5"  placeholder="MM/AA" data-i18n-placeholder="checkout.expiry">
                <input type="text"                placeholder="Nome no cartão" data-i18n-placeholder="checkout.card_name">
            </div>
            <button class="btn-checkout" style="width:100%;margin:18px 0 0" type="button" data-confirm-payment data-i18n="checkout.confirm_payment">Confirmar pagamento</button>
        </div>

        <div class="checkout-success-modal pay-modal" id="modal-pix" role="dialog" aria-modal="true" aria-labelledby="modal-pix-title">
            <button class="modal-close" type="button" data-close-payment><i class="ph ph-x"></i></button>
            <h2 id="modal-pix-title">⚡ Pague com Pix</h2>

            <div id="pix-loading" class="pix-loading">
                <div class="pix-spinner"></div>
                <span>Gerando QR Code...</span>
            </div>

            <div id="pix-content" style="display:none">
                <img id="pix-qr-img" class="pix-qr-img" src="" alt="QR Code Pix">
                <p style="color:#64748b;font-size:.82rem;margin-bottom:4px;font-weight:700">Ou copie o código Pix:</p>
                <div class="pix-code-wrap">
                    <span id="pix-code-text" class="pix-code"></span>
                    <button class="pix-copy-btn" id="pix-copy-btn" type="button" title="Copiar código">
                        <i class="ph ph-copy"></i>
                    </button>
                </div>
                <p style="color:#64748b;font-size:.82rem;font-weight:700;margin-bottom:16px">
                    O pagamento é confirmado automaticamente em instantes.
                </p>
                <button class="btn-checkout" style="width:100%;margin:0" type="button" data-confirm-payment>
                    Já paguei — continuar →
                </button>
            </div>

            <div id="pix-error" style="display:none;color:#991b1b;font-size:.88rem;padding:16px 0;font-weight:700">
                Não foi possível gerar o QR Code. Tente novamente.
            </div>
        </div>
    </div>

    {{-- ── modal de sucesso ── --}}
    <div class="checkout-modal-overlay" id="checkout-success-overlay" aria-hidden="true">
        <div class="checkout-success-modal" role="dialog" aria-modal="true" aria-labelledby="checkout-success-title">
            <div class="checkout-success-badge" aria-hidden="true"><i class="ph ph-check"></i></div>
            <h2 id="checkout-success-title" data-i18n="checkout.success_title">Pedido criado com sucesso!</h2>
            <p data-i18n="checkout.success_desc">Obrigada por confiar no nosso trabalho. Acompanhe o andamento do pedido pelo dashboard.</p>
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
            if (c) c.textContent = readCart().reduce((sum, item) => sum + Number(item.quantity || 1), 0);
        }

        window.removeFromCheckoutCart = function (productId) {
            writeCart(readCart().filter((item) => String(item.id) !== String(productId)));
            updateCartCount();
            renderCart();
            window.showToast?.('Produto removido do carrinho.');
        };

        function renderCart() {
            if (!checkoutItems || !subtotalEl || !totalEl) return;
            const cart = readCart();

            if (!cart.length) {
                checkoutItems.innerHTML = `
                    <div class="checkout-empty">
                        <strong>${_t('checkout.empty')}</strong>
                        <a href="/#produtos">🛍 ${_t('checkout.choose_products')}</a>
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
                        <div class="order-item-price">${Number(item.quantity || 1)}x ${formatCurrency(item.price)}</div>
                    </div>
                    <button class="cart-remove-btn" type="button" onclick="removeFromCheckoutCart(${Number(item.id)})" aria-label="Remover ${escHtml(item.name)}">
                        <i class="ph ph-trash"></i>
                    </button>
                </div>`).join('');

            const subtotal = cart.reduce((s, i) => s + (Number(i.price || 0) * Number(i.quantity || 1)), 0);
            subtotalEl.textContent = formatCurrency(subtotal);
            totalEl.textContent    = formatCurrency(subtotal);
        }

        function closePaymentModal() {
            paymentOverlay.classList.remove('is-open');
            paymentOverlay.setAttribute('aria-hidden', 'true');
            document.querySelectorAll('.pay-modal').forEach((m) => m.classList.remove('is-open'));
        }

        async function openPaymentModal() {
            const id = { credit: 'modal-credit', debit: 'modal-debit', pix: 'modal-pix' }[selectedPaymentMethod] || 'modal-credit';
            document.querySelectorAll('.pay-modal').forEach((m) => m.classList.remove('is-open'));
            document.getElementById(id)?.classList.add('is-open');
            paymentOverlay.classList.add('is-open');
            paymentOverlay.setAttribute('aria-hidden', 'false');

            if (selectedPaymentMethod === 'pix') {
                await gerarQrCodePix();
            }
        }

        async function gerarQrCodePix() {
            const loadingEl = document.getElementById('pix-loading');
            const contentEl = document.getElementById('pix-content');
            const errorEl   = document.getElementById('pix-error');

            loadingEl.style.display = 'flex';
            contentEl.style.display = 'none';
            errorEl.style.display   = 'none';

            const cart     = readCart();
            const subtotal = cart.reduce((s, i) => s + (Number(i.price || 0) * Number(i.quantity || 1)), 0);
            const amount   = subtotal > 0 ? subtotal : 0.01;

            try {
                const res = await fetch(@json(route('pix.gerar')), {
                    method: 'POST',
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ amount }),
                });

                if (!res.ok) throw new Error();
                const data = await res.json();

                document.getElementById('pix-qr-img').src    = `data:image/png;base64,${data.qr_code_base64}`;
                document.getElementById('pix-code-text').textContent = data.qr_code;

                loadingEl.style.display = 'none';
                contentEl.style.display = 'block';

                document.getElementById('pix-copy-btn').onclick = () => {
                    navigator.clipboard.writeText(data.qr_code).then(() => {
                        const btn = document.getElementById('pix-copy-btn');
                        btn.classList.add('copied');
                        btn.innerHTML = '<i class="ph ph-check"></i>';
                        setTimeout(() => {
                            btn.classList.remove('copied');
                            btn.innerHTML = '<i class="ph ph-copy"></i>';
                        }, 2000);
                    });
                };
            } catch {
                loadingEl.style.display = 'none';
                errorEl.style.display   = 'block';
            }
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
            circle.innerHTML = '<span class="radio-dot"></span>';
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
