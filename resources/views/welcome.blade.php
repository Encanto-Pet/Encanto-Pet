<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Pacifico&display=swap"
        rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
   <nav class="navbar">
    <div class="logo">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo PetShop" width="70">
    </div>


<ul class="nav-links">
    <li><a href="#">Produtos</a></li>
    <li><a href="#">Categorias</a></li>
    <li><a href="#">Promoções</a></li>
    <li><a href="#">Alimentação</a></li>
    <li><a href="#">Saúde & Cuidados</a></li>
</ul>

<div class="nav-actions">
    <button class="btn-cart" onclick="showToast('🛒 Carrinho aberto!')">
        🛒 <span id="cart-count">0</span>
    </button>

    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="btn-dashboard">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-login">
                Entrar
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-register">
                    Cadastre-se
                </a>
            @endif
        @endauth
    @endif
</div>

</nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-tag">🐶 Novo em estoque</div>
            <h1>Os melhores produtos<br />para o <span>seu pet</span></h1>
            <p>Encontre ração, brinquedos, acessórios e muito mais com a melhor qualidade e os melhores preços do
                Brasil!</p>
            <a href="#produtos" class="btn-primary">Clique aqui</a>
        </div>
        <div class="hero-blob"></div>
        <img src="{{ asset('assets/img/cachorro-home.svg') }}" alt="Cachorro">
    </section>

    <!-- PARA SEU PET -->
    <!-- <section class="section-pets fade-in">
  <h2 class="section-title">Para o seu pet</h2>
  <p class="section-sub">Escolha pelo tipo do seu bichinho favorito 🥰</p>
  <div class="pets-grid">
    <div class="pet-card" onclick="filterPets('cachorro')">
      <div class="pet-icon">🐶</div>
      <span>Cachorro</span>
    </div>
    <div class="pet-card" onclick="filterPets('gato')">
      <div class="pet-icon">🐱</div>
      <span>Gato</span>
    </div>
    <div class="pet-card" onclick="filterPets('passaro')">
      <div class="pet-icon">🐦</div>
      <span>Pássaro</span>
    </div>
    <div class="pet-card" onclick="filterPets('peixe')">
      <div class="pet-icon">🐟</div>
      <span>Peixe</span>
    </div>
    <div class="pet-card" onclick="filterPets('roedor')">
      <div class="pet-icon">🐹</div>
      <span>Roedor</span>
    </div>
    <div class="pet-card" onclick="filterPets('reptil')">
      <div class="pet-icon">🦎</div>
      <span>Réptil</span>
    </div>
  </div>
</section>
 

<section class="banner-preco fade-in">
  <div class="banner-preco-content">
    <h2>Os melhores <span>preços!</span></h2>
    <p>Qualidade premium nas suas mãos. Ofertas renovadas toda semana com a melhor qualidade pra quem mais você ama! 💛</p>
    <button class="btn-white" onclick="document.getElementById('produtos').scrollIntoView({behavior:'smooth'})">Ver ofertas →</button>
  </div>
  <div class="banner-bird">🦜</div>
</section>
 

<section class="section-produtos fade-in" id="produtos">
  <div class="produtos-header">
    <div>
      <h2 class="section-title" style="margin-bottom:4px">Nossos produtos</h2>
      <p class="section-sub" style="margin-bottom:0">Ração, petiscos, acessórios e muito mais</p>
    </div>
    <div class="filtros">
      <button class="filtro-chip active" onclick="setFiltro(this,'todos')">Todos</button>
      <button class="filtro-chip" onclick="setFiltro(this,'racao')">🥩 Ração</button>
      <button class="filtro-chip" onclick="setFiltro(this,'petisco')">🍖 Petiscos</button>
      <button class="filtro-chip" onclick="setFiltro(this,'brinquedo')">🧸 Brinquedos</button>
      <button class="filtro-chip" onclick="setFiltro(this,'higiene')">🛁 Higiene</button>
    </div>
  </div>
  <div class="produtos-grid" id="produtos-grid"></div>
</section> -->

    <!-- TAXI DOG -->
    <section class="banner-taxi fade-in">
        <div class="banner-taxi-content">
            <h2>Táxi Dog 🐾</h2>
            <p>Leve seu pet com conforto e segurança onde precisar!</p>
            <button class="btn-primary">Agendar agora 🚕</button>
        </div>
        <div class="taxi-emoji">🚕</div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div>
            <h4>🐾 PetShop</h4>
            <p style="font-size:.88rem;line-height:1.6">Os melhores produtos para quem você mais ama. Qualidade
                garantida!</p>
        </div>
        <div>
            <h4>📦 Categorias</h4>
            <ul>
                <li>Cachorros</li>
                <li>Gatos</li>
                <li>Pássaros</li>
                <li>Peixes</li>
                <li>Roedores</li>
            </ul>
        </div>
        <div>
            <h4>ℹ️ Institucional</h4>
            <ul>
                <li>Sobre nós</li>
                <li>Política de privacidade</li>
                <li>Termos de uso</li>
                <li>Trabalhe conosco</li>
            </ul>
        </div>
        <div>
            <h4>📞 Contato</h4>
            <ul>
                <li>📧 contato@petshop.com</li>
                <li>📱 (11) 99999-9999</li>
                <li>📍 São Paulo, SP</li>
            </ul>
        </div>
    </footer>
    <div class="footer-bottom">© 2024 PetShop. Feito com 💛 para os bichinhos.</div>

    <!-- TOAST -->
    <div id="toast"></div>




    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>