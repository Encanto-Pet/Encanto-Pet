<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Encanto Pet') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <div class="logo">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet">
            </div>

            <nav class="menu">
                <a href="#produtos">Produtos</a>
                <a href="#categorias">Cachorros</a>
                <a href="#categorias">Gatos</a>
                <a href="#ofertas">Promoções</a>
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
                    <button class="cart-icon" type="button" onclick="window.location.href='{{ route('checkout') }}'" aria-label="Carrinho">
                        <i class="ph ph-shopping-cart-simple"></i>
                        <span id="cart-count">0</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <div class="hero-brand">
                    <img src="{{ asset('assets/icon/patinha.svg') }}" alt="">
                    <span>Produtos em destaque</span>
                </div>
                <h1>Os melhores produtos<br>para o seu pet</h1>
                <p>
                    Aqui você encontra alimentos, acessórios e cuidados especiais com qualidade.
                    Escolha os produtos cadastrados pela nossa equipe e deixe seu pet feliz.
                </p>
                <a href="#produtos" class="btn-primary">Clique aqui</a>
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
            <h2 class="section-title">Para seu pet</h2>
            <div class="pets-grid">
                <button class="pet-card" type="button" onclick="filterPets('todos')">
                    <span class="pet-icon lilac">🐰</span>
                    <span>Todos</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('brinquedo')">
                    <span class="pet-icon pink">🎾</span>
                    <span>Brinquedos</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('passaro')">
                    <span class="pet-icon yellow">🐦</span>
                    <span>Pássaros</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('gato')">
                    <span class="pet-icon green">🐱</span>
                    <span>Gatos</span>
                </button>
                <button class="pet-card" type="button" onclick="filterPets('cachorro')">
                    <span class="pet-icon blue">🐶</span>
                    <span>Cachorros</span>
                </button>
            </div>
            <div class="carousel-dots" aria-hidden="true">
                <span class="active"></span><span></span><span></span><span></span>
            </div>
        </section>

        <section class="price-callout" id="ofertas">
            <div class="price-copy">
                <span class="mini-line"></span>
                <h2>Os melhores preços!</h2>
                <p>O amor cabe no carrinho: produtos com qualidade e cuidado para todos os pets.</p>
            </div>
            <div class="price-pet">
                <div class="price-circle"></div>
                <img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt="Pet feliz">
            </div>
        </section>

        <section class="shop-section" id="produtos">
            <aside class="shop-filters">
                <h3>Filtrar por categoria</h3>
                <button class="filter-option active" type="button" onclick="setFiltro(this, 'todos')">Todos</button>
                <button class="filter-option" type="button" onclick="setFiltro(this, 'racao')">Ração</button>
                <button class="filter-option" type="button" onclick="setFiltro(this, 'petisco')">Petiscos</button>
                <button class="filter-option" type="button" onclick="setFiltro(this, 'brinquedo')">Brinquedos</button>
                <button class="filter-option" type="button" onclick="setFiltro(this, 'higiene')">Higiene</button>

                <h3>Filtrar por preço</h3>
                <button class="filter-option" type="button" onclick="setFiltro(this, 'ate-50')">Até R$ 50</button>
                <button class="filter-option" type="button" onclick="setFiltro(this, 'ate-100')">Até R$ 100</button>
                <button class="filter-option" type="button" onclick="setFiltro(this, 'acima-100')">Acima de R$ 100</button>
            </aside>

            <div class="shop-content">
                <div class="shop-heading">
                    <div>
                        <span class="mini-line"></span>
                        <h2>Produtos cadastrados</h2>
                    </div>
                    <select aria-label="Ordenar produtos">
                        <option>Mais recentes</option>
                        <option>Menor preço</option>
                        <option>Maior preço</option>
                    </select>
                </div>

                <div class="produtos-grid" id="produtos-grid">
                    @forelse($products as $product)
                        @php
                            $category = strtolower($product->category ?? 'produto');
                            $price = (float) $product->price;
                            $filterCategory = str_contains($category, 'ração') || str_contains($category, 'racao')
                                ? 'racao'
                                : (str_contains($category, 'petisco')
                                    ? 'petisco'
                                    : (str_contains($category, 'brinquedo')
                                        ? 'brinquedo'
                                        : (str_contains($category, 'higiene') || str_contains($category, 'banho') ? 'higiene' : 'outros')));
                        @endphp

                        <article
                            class="produto-card fade-in"
                            data-category="{{ $filterCategory }}"
                            data-price="{{ $price }}"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            data-product-description="{{ $product->description }}"
                            data-product-image="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/cachorro-feliz.svg') }}"
                        >
                            <a href="{{ route('product.show', $product->id) }}" class="product-link">
                                <div class="produto-img">
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
                                                image: @js($product->image ? asset('storage/' . $product->image) : asset('assets/img/cachorro-feliz.svg'))
                                            })"
                                        >+</button>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @empty
                        <div class="empty-products">
                            <strong>Nenhum produto cadastrado ainda.</strong>
                            <span>Quando o admin cadastrar produtos, eles vão aparecer aqui automaticamente.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="banner-taxi">
            <div class="taxi-copy">
                <span>Selecionamos produtos com carinho para quem mora no coração da casa.</span>
                <h2>Táxi Dog</h2>
            </div>
            <img src="{{ asset('assets/img/cachorro na moto.svg') }}" alt="Cachorro em transporte">
        </section>
    </main>

    <footer id="footer">
        <div>
            <h4>🐾 Encanto Pet</h4>
            <p>Produtos, cuidados e carinho para todos os pets.</p>
        </div>
        <div>
            <h4>Categorias</h4>
            <ul>
                <li>Cachorros</li>
                <li>Gatos</li>
                <li>Pássaros</li>
                <li>Peixes</li>
            </ul>
        </div>
        <div>
            <h4>Institucional</h4>
            <ul>
                <li>Sobre nós</li>
                <li>Política de privacidade</li>
                <li>Termos de uso</li>
            </ul>
        </div>
        <div>
            <h4>Contato</h4>
            <ul>
                <li>contato@encantopet.com</li>
                <li>(11) 99999-9999</li>
                <li>São Paulo, SP</li>
            </ul>
        </div>
    </footer>
    <div class="footer-bottom">© 2026 Encanto Pet. Feito com carinho para os bichinhos.</div>

    <div id="toast"></div>
</body>
</html>
