<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar senha - Encanto Pet</title>
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
        @if(session('success'))<div class="notice" data-i18n="admin.password_success">{{ session('success') }}</div>@endif
        <div class="hero-head">
            <div><h1 class="page-title" data-i18n="admin.password_title">Alterar senha</h1><p class="page-subtitle" data-i18n="admin.password_subtitle">Mantenha sua conta administrativa protegida.</p></div>
            <div class="dog-badge"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div>
        </div>
        <div class="panel">
            <form class="form-grid" method="POST" action="{{ route('admin.password.update') }}">
                @csrf
                @method('PUT')
                <div class="field-row">
                    <label for="current_password" data-i18n="admin.current_password">Senha atual</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password" required>
                    @error('current_password')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="field-row">
                    <label for="password" data-i18n="admin.new_password">Nova senha</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required>
                    @error('password')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="field-row">
                    <label for="password_confirmation" data-i18n="admin.confirm_password">Confirmar nova senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
                    @error('password_confirmation')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="actions">
                    <button class="btn btn-primary" type="submit"><i class="ph ph-lock-key"></i><span data-i18n="admin.save_password">Salvar senha</span></button>
                    <a class="btn" href="{{ route('admin.dashboard') }}" data-i18n="admin.back_dashboard">Voltar ao dashboard</a>
                </div>
            </form>
        </div>
    </section>
</main>
</body>
</html>
