<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Encanto Pet') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="{{ asset('css/i18n.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/i18n/translations.js') }}"></script>
    <script src="{{ asset('js/i18n/i18n.js') }}"></script>
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <div class="logo">
            <a href="/"><img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet"></a>
            </div>

            <nav class="menu">
                <a href="#produtos"    data-i18n="nav.products">Produtos</a>
                <a href="#categorias"  data-i18n="nav.dogs">Cachorros</a>
                <a href="#categorias"  data-i18n="nav.cats">Gatos</a>
                <a href="#ofertas"     data-i18n="nav.promotions">Promoções</a>
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

    <main>
        <section class="hero">
            <div class="hero-content">
                <div class="hero-brand">
                    <img src="{{ asset('assets/icon/patinha.svg') }}" alt="">
                    <span data-i18n="home.hero_highlight">Produtos em destaque</span>
                </div>
                <h1 data-i18n="home.hero_title">Os melhores produtos<br>para o seu pet</h1>
                <p data-i18n="home.hero_desc">
                    Aqui você encontra alimentos, acessórios e cuidados especiais com qualidade.
                    Escolha os produtos cadastrados pela nossa equipe e deixe seu pet feliz.
                </p>
                <a href="#produtos" class="btn-primary" data-i18n="home.hero_btn">Clique aqui</a>
                <div class="hero-lines" aria-hidden="true">
                    <span></span><span></span><span></span>
                </div>
            </div>

            <div class="hero-media">
                <div class="hero-shape"></div>
                <img src="{{ asset('assets/img/cachorro-home.svg') }}" alt="Cachorro com ração">
                <div class="hero-dish" aria-hidden="true"></div>
            </div>
        </section>

        <section class="section-pets" id="categorias">
            <h2 class="section-title" data-i18n="home.section_pets">Para seu pet</h2>
            <div class="pets-grid">
                <button class="pet-card" type="button" onclick="filterPets('todos')">
                    <span class="pet-icon lilac">🐰</span>
                    <span data-i18n="home.all">Todos</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('brinquedos')">
                    <span class="pet-icon pink">🎾</span>
                    <span data-i18n="home.toys">Brinquedos</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('passaro')">
                    <span class="pet-icon yellow">🐦</span>
                    <span data-i18n="home.birds">Pássaros</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('gato')">
                    <span class="pet-icon green">🐱</span>
                    <span data-i18n="home.cats">Gatos</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('cachorro')">
                    <span class="pet-icon blue">🐶</span>
                    <span data-i18n="home.dogs">Cachorros</span>
                </button>
            </div>
            <div class="carousel-dots" aria-hidden="true">
                <span class="active"></span><span></span><span></span><span></span>
            </div>
        </section>

        <section class="price-callout" id="ofertas">
            <div class="price-copy">
                <span class="mini-line"></span>
                <h2 data-i18n="home.best_prices">Os melhores preços!</h2>
                <p data-i18n="home.price_desc">O amor cabe no carrinho: produtos com qualidade e cuidado para todos os pets.</p>
            </div>
            <div class="price-pet">
                <div class="price-circle"></div>
                <img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt="Pet feliz">
            </div>
        </section>

        <section class="shop-section" id="produtos">
            <aside class="shop-filters">
                <h3 data-i18n="home.filter_category">Filtrar por categoria</h3>
                <button class="filter-option active" type="button" data-filter-type="category" onclick="setFiltro(this, 'todos', 'category')">Todos</button>
                <button class="filter-option" type="button" data-filter-type="category" onclick="setFiltro(this, 'racao', 'category')">Ração</button>
                <button class="filter-option" type="button" data-filter-type="category" onclick="setFiltro(this, 'petisco', 'category')">Petisco</button>
                <button class="filter-option" type="button" data-filter-type="category" onclick="setFiltro(this, 'brinquedos', 'category')">Brinquedos</button>
                <button class="filter-option" type="button" data-filter-type="category" onclick="setFiltro(this, 'higiene', 'category')">Higiene</button>
                <button class="filter-option" type="button" data-filter-type="category" onclick="setFiltro(this, 'outros', 'category')">Outros</button>

                <h3 data-i18n="home.filter_price">Filtrar por preço</h3>
                <button class="filter-option active" type="button" data-filter-type="price" onclick="setFiltro(this, 'todos', 'price')">Todos os preços</button>
                <button class="filter-option" type="button" data-filter-type="price" onclick="setFiltro(this, 'ate-50', 'price')" data-i18n="home.up_to_50">Até R$ 50</button>
                <button class="filter-option" type="button" data-filter-type="price" onclick="setFiltro(this, 'ate-100', 'price')" data-i18n="home.up_to_100">Até R$ 100</button>
                <button class="filter-option" type="button" data-filter-type="price" onclick="setFiltro(this, 'acima-100', 'price')" data-i18n="home.above_100">Acima de R$ 100</button>
            </aside>

            <div class="shop-content">
                <div class="shop-heading">
                    <div>
                        <span class="mini-line"></span>
                        <h2 data-i18n="home.registered_products">Produtos cadastrados</h2>
                    </div>
                    <select aria-label="Ordenar produtos">
                        <option data-i18n="home.most_recent">Mais recentes</option>
                        <option data-i18n="home.lowest_price">Menor preço</option>
                        <option data-i18n="home.highest_price">Maior preço</option>
                    </select>
                </div>

                <div class="produtos-grid" id="produtos-grid">
                    @forelse($products as $product)
                        @php
                            $category = $product->category;
                            $price = (float) $product->price;
                            $filterCategory = array_key_exists($category, \App\Models\Product::categoryOptions())
                                ? $category
                                : 'outros';
                        @endphp

                        <article
                            class="produto-card fade-in {{ $product->is_active ? '' : 'is-unavailable' }}"
                            data-category="{{ $filterCategory }}"
                            data-price="{{ $price }}"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            data-product-description="{{ $product->description }}"
                            data-product-image="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/cachorro-feliz.svg') }}"
                            data-active="{{ $product->is_active ? '1' : '0' }}"
                        >
                            <a href="{{ route('product.show', $product->id) }}" class="product-link">
                                <div class="produto-img">
                                    @unless($product->is_active)
                                        <span class="unavailable-badge">Indisponível</span>
                                    @endunless
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <span>🐾</span>
                                    @endif
                                </div>
                                <div class="produto-info">
                                    <h3 class="produto-nome">{{ $product->name }}</h3>
                                    <p class="produto-desc">{{ $product->description }}</p>
                                    <div class="produto-preco-row">
                                        <strong class="produto-preco">R$ {{ number_format($product->price, 2, ',', '.') }}</strong>
                                        <button
                                            class="btn-add"
                                            type="button"
                                            onclick="addToCart(event, {
                                                id: {{ $product->id }},
                                                name: @js($product->name),
                                                description: @js($product->description),
                                                price: {{ $price }},
                                                image: @js($product->image ? asset('storage/' . $product->image) : asset('assets/img/cachorro-feliz.svg')),
                                                is_active: @js((bool) $product->is_active)
                                            })"
                                            @disabled(! $product->is_active)
                                            aria-label="{{ $product->is_active ? 'Adicionar ao carrinho' : 'Produto indisponível' }}"
                                        >+</button>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @empty
                        <div class="empty-products">
                            <strong data-i18n="home.no_products">Nenhum produto cadastrado ainda.</strong>
                            <span data-i18n="home.no_products_sub">Quando o admin cadastrar produtos, eles vão aparecer aqui automaticamente.</span>
                        </div>
                    @endforelse

                    <div class="empty-products is-hidden" id="products-search-empty">
                        <strong data-i18n="home.no_search_results">Nenhum produto encontrado.</strong>
                        <span data-i18n="home.no_search_sub">Tente buscar por outro nome ou categoria.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="banner-taxi">
            <div class="taxi-copy">
                <span data-i18n="home.taxi_desc">Selecionamos produtos com carinho para quem mora no coração da casa.</span>
                <h2 data-i18n="home.taxi_dog">Táxi Dog</h2>
            </div>
            <img src="{{ asset('assets/img/cachorro na moto.svg') }}" alt="Cachorro em transporte">
        </section>
    </main>

    <footer id="footer">
        <div>
            <h4>🐾 Encanto Pet</h4>
            <p data-i18n="footer.tagline">Produtos, cuidados e carinho para todos os pets.</p>
        </div>
        <div>
            <h4 data-i18n="footer.categories">Categorias</h4>
            <ul>
                <li data-i18n="footer.dogs">Cachorros</li>
                <li data-i18n="footer.cats">Gatos</li>
                <li data-i18n="footer.birds">Pássaros</li>
                <li data-i18n="footer.fish">Peixes</li>
            </ul>
        </div>
        <div>
            <h4 data-i18n="footer.institutional">Institucional</h4>
            <ul>
                <li data-i18n="footer.about">Sobre nós</li>
                <li data-i18n="footer.privacy">Política de privacidade</li>
                <li data-i18n="footer.terms">Termos de uso</li>
            </ul>
        </div>
        <div>
            <h4 data-i18n="footer.contact">Contato</h4>
            <ul>
                <li>contato@encantopet.com</li>
                <li>(11) 99999-9999</li>
                <li>São Paulo, SP</li>
            </ul>
        </div>
    </footer>
    <div class="footer-bottom" data-i18n="footer.copyright">© 2026 Encanto Pet. Feito com carinho para os bichinhos.</div>

    <div id="toast"></div>
</body>
</html>
