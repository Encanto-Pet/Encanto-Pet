
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Encanto Pet - Perfil</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/profile/usuario.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
        

    </head>
    <body>
        <header class="navbar">
            <div class="nav-container">

                <div class="logo">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet">
                </div>

                <nav class="menu">
                    <a href="#">Produtos</a>
                    <a href="#">Cachorros</a>
                    <a href="#">Gatos</a>
                    <a href="#">Promoções</a>
                    <a href="#">Adote aqui!</a>
                    <a href="#">Nosso contato</a>
                </nav>

                <div class="nav-right">
                    <div class="search">
                        <input type="text" placeholder="Pesquise produtos...">
                        <span><img src="../../../assets/icon/lupa.svg" alt="Pesquisar"></span>
                    </div>

                    <div class="icons">
                        <a href="#" alt="Notificação"><i class="ph ph-bell"></i></a>
                        <a href="#" alt="Login"><i class="ph ph-user"></i></a>
                        <a href="#" alt="Internacionalização"><i class="ph ph-globe-hemisphere-west"></i></a>
                    </div>
                </div>
            </div>
        </header>
        <section class="container">
            <aside class="sidebar">
                <div class="titulo">
                    <h1>Sua conta Encanto<i class="ph ph-bird"></i></h1>
                </div>

                <a href="#" alt="Sua conta" class="menu-item active"><i class="ph ph-user"></i>Minha conta</a>

                <a href="#" alt="Notificações" class="menu-item"><i class="ph ph-bell-simple-ringing"></i>Notificações</a>

                <a href="#" alt="Alterar senha" class="menu-item"><i class="ph ph-lock"></i>Alteração de senha</a>

                <a href="#" alt="Seus pedidos" class="menu-item"><i class="ph ph-shopping-cart-simple"></i>Meus pedidos</a>

                <a href="#" alt="Fale conosco" class="menu-item"><i class="ph ph-headset"></i>Fale conosco</a>

                <a href="#" alt="Sair da conta" class="menu-item"><i class="ph ph-sign-out"></i>Sair</a>
            </aside>

            <main class="content">
                {{ $slot }}
            </main>
            @if(request()->routeIs('dashboard') || request()->routeIs('profile.edit'))
                <div class="dog-decoration">
                    <img 
                        src="{{ asset('assets/img/fotoperfil.svg') }}" 
                        alt="Dog"
                    >
                </div>
            @endif
            
    </section>
    </body>
    </html>
