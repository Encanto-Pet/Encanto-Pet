<x-guest-layout>

    <!-- STATUS -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <main class="container">

        <!-- ESQUERDA -->
        <section class="left">

            <h1>
                Pronto para encher<br>
                o carrinho?
            </h1>

            <p class="subtitle">
                Se você não tem uma conta, 
                <a href="{{ route('register') }}">crie uma aqui!</a>
            </p>

            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf

                <!-- EMAIL -->
                <div>
                    <x-text-input 
                        id="email"
                        class="input"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="Insira o seu email"
                        required 
                        autofocus 
                        autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="error" />
                </div>

                <!-- SENHA -->
                <div class="password-wrapper">

                    <x-text-input 
                        id="senha"
                        class="input"
                        type="password"
                        name="password"
                        placeholder="********"
                        required 
                        autocomplete="current-password" 
                    />

                    <button type="button" id="toggleSenha" aria-label="Mostrar senha">
                        <img 
                          src="{{ asset('assets/icon/cachorro-olho-fechado.svg') }}"
                          data-aberto="{{ asset('assets/icon/cachorro-olho-aberto.svg') }}"
                          data-fechado="{{ asset('assets/icon/cachorro-olho-fechado.svg') }}"
                          id="iconeSenha"
                          alt="Mostrar senha"
                        >
                    </button>

                </div>

                <x-input-error :messages="$errors->get('password')" class="error" />

                <!-- ESQUECEU SENHA -->
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">
                        Esqueci a senha
                    </a>
                @endif

                <!-- REMEMBER -->
                <label class="check">
                    <input type="checkbox" name="remember">
                    Lembrar a senha
                </label>

                <!-- BOTÃO -->
                <x-primary-button class="btn">
                    Entrar
                </x-primary-button>

            </form>

        </section>

        <!-- DIREITA -->
        <section class="right">
            <img src="{{ asset('assets/img/cachorro login.svg') }}" alt="Cachorro feliz">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo Encanto Pet" class="logo">
        </section>

    </main>

    <!-- JS SENHA -->
    <script>
        const toggle = document.getElementById('toggleSenha');
        const senha = document.getElementById('senha');
        const icone = document.getElementById('iconeSenha');

        toggle.addEventListener('click', () => {
            const isPassword = senha.type === 'password';
            senha.type = isPassword ? 'text' : 'password';

            icone.src = isPassword 
                ? icone.dataset.aberto 
                : icone.dataset.fechado;
        });
    </script>

</x-guest-layout>