<x-guest-layout>
<link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
<main class="container">

    <!-- ESQUERDA -->
    <section class="left">

        <h1>
            Seu pet autorizou<br>
            esse cadastro!
        </h1>

        <p class="subtitle">
            Mas caso já tenha cadastro,<br> 
            <a href="{{ route('login') }}">Acesse sua conta!</a>
        </p>

        <div class="wrapper">
            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf

                <!-- NOME -->
                <div class="input-group">
                    <label for="name">Nome</label>

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
                    <label for="email">Email</label>

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
                    <label for="password">Senha</label>

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
                    <label for="password_confirmation">Confirmação de senha</label>

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

                <!-- BOTÃO -->
             
                <!-- EXTRAS -->
                <div class="extras">

                    <label class="check">
                        <input type="checkbox" name="remember">
                        Lembrar a senha
                    </label>

                    <label class="check">
                        <input type="checkbox" required>
                        Aceito com os 
                        <a href="#">Termos de Uso</a> 
                        e 
                        <a href="#">Política</a>
                    </label>

                       <x-primary-button class="btn">
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