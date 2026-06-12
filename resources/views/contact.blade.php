<x-app-layout>
    <style>
        .contact-page { max-width: 760px; }
        .contact-page .panel { border-radius: 18px; padding: 28px; background: #fff; box-shadow: 0 16px 35px rgba(32,45,70,.07); }
        .contact-page .form-grid { display: grid; gap: 18px; }
        .contact-page .field-row { display: grid; gap: 7px; }
        .contact-page label { color: #596270; font-size: 13px; font-weight: 900; }
        .contact-page input,.contact-page textarea { width: 100%; min-height: 44px; border: 0; border-radius: 12px; padding: 12px 14px; color: #272936; background: #eef4fa; box-shadow: 0 7px 13px rgba(42,58,78,.12); outline: 0; font-weight: 800; }
        .contact-page textarea { min-height: 150px; resize: vertical; }
        .contact-page input:focus,.contact-page textarea:focus { background: #fff; box-shadow: 0 0 0 3px rgba(246,182,11,.22),0 7px 13px rgba(42,58,78,.14); }
        .contact-page .btn { min-height: 38px; border: 1px solid #f6b60b; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 8px 16px; color: #303341; background: #f6b60b; font-size: 13px; font-weight: 900; cursor: pointer; }
        .contact-page .error { color: #c73737; font-size: 12px; font-weight: 900; }
        .contact-success { margin-bottom: 18px; border-radius: 12px; padding: 12px 16px; color: #2f6c22; background: #dff3d8; font-weight: 900; }
    </style>
    <div class="contact-wrapper contact-page">
        <div class="contact-info">
            <h2 data-i18n="contact.greeting" data-i18n-name="{{ auth()->user()?->name }}">Olá, {{ auth()->user()?->name }}!<br>Esperamos que esteja tudo bem.</h2>
            <div class="contact-subtitle">
                <i class="ph ph-chat-circle-text"></i>
                <span data-i18n="contact.form_subtitle">Envie uma mensagem para a equipe Encanto Pet.</span>
            </div>
            @if(session('success'))<div class="contact-success" data-i18n="contact.success">{{ session('success') }}</div>@endif
            @include('contact-form')
        </div>
    </div>
</x-app-layout>
