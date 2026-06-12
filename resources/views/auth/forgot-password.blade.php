<x-guest-layout>
<link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
<main class="container">

    <section class="left">

        <h1 data-i18n="forgot.title">
            Digite seu email e volte<br>
            para o mundo Pet!
        </h1>

        <p class="subtitle" data-i18n="forgot.subtitle">
            Digite o seu e-mail cadastrado para <br>
            receber o código de verificação!
        </p>

        <!-- Status (quando email é enviado) -->
        <x-auth-session-status
            class="mb-3"
            :status="session('status')"
        />

        <form method="POST" action="{{ route('password.email') }}" class="form">
            @csrf

            <!-- Email -->
            <div>
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    data-i18n-placeholder="forgot.email_placeholder"
                    placeholder="Insira o seu email"
                    :value="old('email')"
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <button type="submit" class="btn" data-i18n="forgot.submit">
                Enviar
            </button>

        </form>

    </section>

    <section class="right">
        <img src="{{ asset('assets/img/gatinho-laranja-esqueceu-senha.svg') }}" alt="">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo Encanto Pet" class="logo">
    </section>

</main>

</x-guest-layout>
