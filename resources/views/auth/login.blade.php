<x-guest-layout>

    <!-- STATUS -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <main class="container">

        <!-- ESQUERDA -->
        <section class="left">

            <h1 data-i18n="login.title">
                Pronto para encher<br>
                o carrinho?
            </h1>

            <p class="subtitle">
                <span data-i18n="login.subtitle">Se você não tem uma conta, </span>
                <a href="{{ route('register') }}" data-i18n="login.register_link">crie uma aqui!</a>
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
                        data-i18n-placeholder="login.email_placeholder"
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

                    <button type="button" id="toggleSenha" data-i18n-aria="login.show_password" aria-label="Mostrar senha">
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
                    <a href="{{ route('password.request') }}" class="forgot" data-i18n="login.forgot">
                        Esqueci a senha
                    </a>
                @endif

                <!-- REMEMBER -->
                <label class="custom-checkbox">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                    <span data-i18n="login.remember">Lembrar a senha</span>
                </label>

                <!-- BOTÃO -->
                <x-primary-button class="btn" data-i18n="login.submit">
                    Entrar
                </x-primary-button>

            </form>

        </section>

        <!-- DIREITA -->
        <section class="right">
            <img src="{{ asset('assets/img/cachorro login.svg') }}" alt="Cachorro feliz">
            <a src="{{ asset('assets/img/logo.svg') }}" alt="Logo Encanto Pet" class="logo" href="{{ url('welcome.blade') }}"></a>
        </section>

    </main>

    <!-- JS SENHA -->
    <script>
        const toggle = document.getElementById('toggleSenha');
        const senha  = document.getElementById('senha');
        const icone  = document.getElementById('iconeSenha');

        toggle.addEventListener('click', () => {
            const isPassword = senha.type === 'password';
            senha.type = isPassword ? 'text' : 'password';
            icone.src  = isPassword ? icone.dataset.aberto : icone.dataset.fechado;
        });
    </script>

</x-guest-layout>
