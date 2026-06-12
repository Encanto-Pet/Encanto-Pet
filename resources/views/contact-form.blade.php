@php($user = auth()->user())
<div class="panel">
    <form class="form-grid" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="field-row">
            <label for="name" data-i18n="contact.name">Nome</label>
            <input id="name" name="name" value="{{ old('name', $user?->name) }}" required>
            @error('name')<span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="field-row">
            <label for="email" data-i18n="contact.email">E-mail</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user?->email) }}" required>
            @error('email')<span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="field-row">
            <label for="subject" data-i18n="contact.subject">Assunto</label>
            <input id="subject" name="subject" value="{{ old('subject') }}" required>
            @error('subject')<span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="field-row">
            <label for="message" data-i18n="contact.message">Mensagem</label>
            <textarea id="message" name="message" required>{{ old('message') }}</textarea>
            @error('message')<span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="actions">
            <button class="btn btn-primary" type="submit"><i class="ph ph-paper-plane-tilt"></i><span data-i18n="contact.send">Enviar</span></button>
        </div>
    </form>
</div>
