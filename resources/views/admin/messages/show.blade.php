<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem - Encanto Pet</title>
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
        @if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
        <div class="hero-head">
            <div><h1 class="page-title">{{ $message->subject }}</h1><p class="page-subtitle"><span data-i18n="admin.message_from">Mensagem enviada por</span> {{ $message->name }}.</p></div>
            <div class="dog-badge"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div>
        </div>
        <div class="panel">
            <div class="meta-grid">
                <div class="meta-card"><small data-i18n="contact.name">Nome</small><strong>{{ $message->name }}</strong></div>
                <div class="meta-card"><small data-i18n="contact.email">E-mail</small><strong>{{ $message->email }}</strong></div>
                <div class="meta-card"><small data-i18n="contact.sent_at">Data do envio</small><strong>{{ $message->created_at?->format('d/m/Y H:i') }}</strong></div>
                <div class="meta-card"><small>Status</small><strong><span class="badge badge-{{ $message->status_class }}">{{ $message->status_label }}</span></strong></div>
            </div>
            <div class="message-body">{{ $message->message }}</div>
            <form class="actions" method="POST" action="{{ route('admin.messages.status', $message) }}">
                @csrf
                @method('PATCH')
                <select name="status" class="btn">
                    @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}" @selected($message->status === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit" data-i18n="admin.update_status">Atualizar status</button>
                <a class="btn" href="{{ route('admin.messages.index') }}" data-i18n="admin.back_messages">Voltar às mensagens</a>
            </form>
        </div>
    </section>
</main>
</body>
</html>
