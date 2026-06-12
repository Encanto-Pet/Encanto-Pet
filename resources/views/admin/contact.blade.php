<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale conosco - Encanto Pet</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="{{ asset('css/i18n.css') }}">
    <script src="{{ asset('js/i18n/translations.js') }}"></script>
    <script src="{{ asset('js/i18n/i18n.js') }}"></script>
    @include('admin.partials.page-style')
</head>
<body>
@include('admin.partials.sidebar')
<main class="main">
    <header class="topbar">
        <form class="search-bar" method="GET" action="{{ route('admin.messages.index') }}"><input name="search" placeholder="Pesquisar mensagens..."><i class="ph ph-magnifying-glass"></i></form>
        <div class="topbar-right"><div class="admin-face"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div><div><div class="admin-name">{{ auth()->user()->name }}</div><div class="admin-role">Adm</div></div><i class="ph ph-bell"></i></div>
    </header>
    <section class="content">
        @if(session('success'))<div class="notice" data-i18n="contact.success">{{ session('success') }}</div>@endif
        <div class="hero-head">
            <div><h1 class="page-title" data-i18n="contact.title">Fale conosco</h1><p class="page-subtitle" data-i18n="contact.form_subtitle">Envie uma mensagem para a equipe Encanto Pet.</p></div>
            <div class="dog-badge"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div>
        </div>
        @include('contact-form')
    </section>
</main>
</body>
</html>
