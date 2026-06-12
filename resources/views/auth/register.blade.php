<x-guest-layout>
<link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
<main class="container">

    <!-- ESQUERDA -->
    <section class="left">

        <h1 data-i18n="register.title">
            Seu pet autorizou<br>
            esse cadastro!
        </h1>

        <p class="subtitle">
            <span data-i18n="register.subtitle">Mas caso já tenha cadastro,</span><br>
            <a href="{{ route('login') }}" data-i18n="register.login_link">Acesse sua conta!</a>
        </p>

        <div class="wrapper">
            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf

                <!-- NOME -->
                <div class="input-group">
                    <label for="name" data-i18n="register.name">Nome</label>

                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="input"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <x-input-error :messages="$errors->get('name')" class="error" />
                </div>

                <!-- EMAIL -->
                <div class="input-group">
                    <label for="email" data-i18n="register.email">Email</label>

                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="input"
                        :value="old('email')"
                        required
                        autocomplete="username"
                    />

                    <x-input-error :messages="$errors->get('email')" class="error" />
                </div>

                <!-- SENHA -->
                <div class="input-group">
                    <label for="password" data-i18n="register.password">Senha</label>

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="input"
                        required
                        autocomplete="new-password"
                    />

                    <x-input-error :messages="$errors->get('password')" class="error" />
                </div>

                <!-- CONFIRMAR SENHA -->
                <div class="input-group">
                    <label for="password_confirmation" data-i18n="register.confirm_password">Confirmação de senha</label>

                    <x-text-input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="input"
                        required
                        autocomplete="new-password"
                    />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
                </div>

                <!-- EXTRAS -->
                <div class="extras">

                    <label class="check">
                        <input type="checkbox" name="remember">
                        <span data-i18n="register.remember">Lembrar a senha</span>
                    </label>

                    <label class="check">
                        <input type="checkbox" required>
                        <span data-i18n="register.terms_prefix">Aceito com os </span>
                        <a href="#" data-i18n="register.terms_link">Termos de Uso</a>
                        <span data-i18n="register.terms_and"> e </span>
                        <a href="#" data-i18n="register.policy_link">Política</a>
                    </label>

                    <x-primary-button class="btn" data-i18n="register.submit">
                        Finalizar!
                    </x-primary-button>

                </div>

            </form>
        </div>

    </section>

    <!-- DIREITA -->
    <section class="right">
        <img src="{{ asset('assets/img/imagem animais cadastro.svg') }}" alt="Cachorro feliz">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo Encanto Pet" class="logo">
    </section>

</main>

</x-guest-layout>
