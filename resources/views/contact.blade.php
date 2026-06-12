<x-app-layout>
    <div class="contact-wrapper">
        <div class="contact-info">
            <h2 data-i18n="contact.greeting" data-i18n-name="{{ auth()->user()?->name }}">Olá, {{ auth()->user()?->name }}!<br>Esperamos que esteja tudo bem.</h2>
            <div class="contact-subtitle">
                <i class="ph ph-chat-circle-text"></i>
                <span data-i18n="contact.subtitle">Caso precise falar conosco, entre em contato através dos nossos canais de comunicação abaixo:</span>
            </div>
            <div class="contact-channels">
                <a href="tel:+5511949622700" class="contact-channel">
                    <i class="ph ph-phone"></i>
                    <span>+55 (11) 94962-2700</span>
                </a>
                <a href="mailto:encantoaet@gmail.com" class="contact-channel">
                    <i class="ph ph-envelope-simple"></i>
                    <span>encantoaet@gmail.com</span>
                </a>
                <a href="tel:+551148618674" class="contact-channel">
                    <i class="ph ph-phone"></i>
                    <span>(11) 4861-8674</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
