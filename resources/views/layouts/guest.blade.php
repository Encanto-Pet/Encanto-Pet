<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Encanto Pet') }}</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/i18n.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/i18n/translations.js') }}"></script>
        <script src="{{ asset('js/i18n/i18n.js') }}"></script>
    </head>
    <body>

        {{-- Seletor de idioma flutuante para páginas de autenticação --}}
        <div class="lang-switcher lang-switcher-float">
            <button class="lang-btn" onclick="toggleLangMenu(event)" data-i18n-aria="nav.lang_label" aria-label="Selecionar idioma">
                <i class="ph ph-globe-hemisphere-west" style="font-size:19px;"></i>
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

        <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">

        {{ $slot }}
    </body>
</html>
