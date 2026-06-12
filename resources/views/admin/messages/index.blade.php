<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens - Encanto Pet</title>
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
        <form class="search-bar" method="GET" action="{{ route('admin.messages.index') }}"><input name="search" value="{{ $search }}" placeholder="Pesquisar mensagens..."><i class="ph ph-magnifying-glass"></i></form>
        <div class="topbar-right"><div class="admin-face"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div><div><div class="admin-name">{{ auth()->user()->name }}</div><div class="admin-role">Adm</div></div><i class="ph ph-bell"></i></div>
    </header>
    <section class="content">
        @if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
        <div class="hero-head">
            <div><h1 class="page-title" data-i18n="admin.messages_title">Mensagens</h1><p class="page-subtitle"><span data-i18n="admin.messages_subtitle">Mensagens reais enviadas pelo Fale conosco.</span> {{ $newMessagesCount }} <span data-i18n="admin.new_messages">novas</span>.</p></div>
            <div class="dog-badge"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div>
        </div>
        <div class="panel wide">
            <form class="filters" method="GET" action="{{ route('admin.messages.index') }}">
                <input name="search" value="{{ $search }}" placeholder="Nome, e-mail ou assunto">
                <select name="status">
                    <option value="" data-i18n="admin.all_statuses">Todos os status</option>
                    @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit"><i class="ph ph-magnifying-glass"></i><span data-i18n="admin.search">Pesquisar</span></button>
            </form>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Nome</th><th>E-mail</th><th>Assunto</th><th>Status</th><th>Data do envio</th><th></th></tr></thead>
                    <tbody>
                    @forelse($messages as $message)
                        <tr class="{{ $message->status === \App\Models\ContactMessage::STATUS_NEW ? 'is-new' : '' }}">
                            <td><strong>{{ $message->name }}</strong></td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td><span class="badge badge-{{ $message->status_class }}">{{ $message->status_label }}</span></td>
                            <td>{{ $message->created_at?->format('d/m/Y H:i') }}</td>
                            <td><a class="btn btn-blue" href="{{ route('admin.messages.show', $message) }}" data-i18n="admin.open">Abrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Nenhuma mensagem encontrada.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-links">{{ $messages->links() }}</div>
        </div>
    </section>
</main>
</body>
</html>
