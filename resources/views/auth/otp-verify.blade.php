<x-guest-layout>
<link rel="stylesheet" href="{{ asset('css/confirmacao-email.css') }}">

<img src="{{ asset('assets/img/logo.svg') }}" class="logo" alt="Encanto Pet">

<div class="otp-container">

    <h1>
        Seu código chegou!<br>
        É só digitar para continuar.
    </h1>

    <img src="{{ asset('assets/img/cachorro-codigo.svg') }}" class="dog" alt="">

    <p class="email-info">Enviamos um código de 6 dígitos para <strong>{{ $email }}</strong></p>

    {{-- Mensagem de sucesso (reenvio) --}}
    @if (session('status'))
        <div class="alert alert-success">
            <span>✓</span> {{ session('status') }}
        </div>
    @endif

    {{-- Erro no código --}}
    @error('code')
        <div class="alert alert-error">
            <span>✕</span> {{ $message }}
        </div>
    @enderror

    {{-- Erro no reenvio --}}
    @error('resend')
        <div class="alert alert-error">
            <span>✕</span> {{ $message }}
        </div>
    @enderror

    {{-- Formulário OTP --}}
    <form method="POST" action="{{ route('otp.verify') }}" id="otp-form" autocomplete="off">
        @csrf
        <input type="hidden" name="code" id="otp-hidden">

        <div class="codigo" id="codigo-wrapper">
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]" autocomplete="one-time-code">
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]">
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]">
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]">
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]">
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]">
        </div>

        <div id="loading-state" class="loading-state" style="display:none;">
            <div class="spinner"></div>
            <span>Verificando...</span>
        </div>

    </form>

    {{-- Reenvio --}}
    <p class="reenviar">
        Não chegou o código?
        <form method="POST" action="{{ route('otp.resend') }}" id="resend-form" style="display:inline">
            @csrf
            <button
                type="submit"
                id="resend-btn"
                class="resend-btn"
                {{ $resendCooldown > 0 ? 'disabled' : '' }}
            >Reenviar email!</button>
        </form>
    </p>

    <span class="timer" id="timer">
        {{ $resendCooldown > 0
            ? sprintf('%02d:%02d', intdiv($resendCooldown, 60), $resendCooldown % 60)
            : '' }}
    </span>

</div>

<script>
(function () {
    const inputs      = Array.from(document.querySelectorAll('.otp-input'));
    const hiddenInput = document.getElementById('otp-hidden');
    const form        = document.getElementById('otp-form');
    const loadingEl   = document.getElementById('loading-state');
    const codigoEl    = document.getElementById('codigo-wrapper');
    const resendBtn   = document.getElementById('resend-btn');
    const timerEl     = document.getElementById('timer');

    let countdown = {{ $resendCooldown }};

    // ── Countdown timer ──────────────────────────────────────────────────────
    if (countdown > 0) {
        const tick = setInterval(() => {
            countdown--;
            if (countdown <= 0) {
                clearInterval(tick);
                timerEl.textContent = '';
                resendBtn.disabled  = false;
            } else {
                const m = Math.floor(countdown / 60);
                const s = countdown % 60;
                timerEl.textContent = `${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
            }
        }, 1000);
    }

    // ── OTP input behaviour ──────────────────────────────────────────────────
    inputs.forEach((input, idx) => {

        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '').slice(-1);
            syncAndMaybeSubmit();
            if (input.value && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace') {
                if (input.value) {
                    input.value = '';
                    syncAndMaybeSubmit();
                } else if (idx > 0) {
                    inputs[idx - 1].focus();
                    inputs[idx - 1].value = '';
                    syncAndMaybeSubmit();
                }
                e.preventDefault();
            }
            if (e.key === 'ArrowLeft' && idx > 0) inputs[idx - 1].focus();
            if (e.key === 'ArrowRight' && idx < inputs.length - 1) inputs[idx + 1].focus();
        });

        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData)
                .getData('text')
                .replace(/\D/g, '')
                .slice(0, 6);
            paste.split('').forEach((ch, i) => {
                if (inputs[i]) inputs[i].value = ch;
            });
            syncAndMaybeSubmit();
            const nextIdx = Math.min(paste.length, inputs.length - 1);
            inputs[nextIdx].focus();
        });

        // Allow only digits on keypress
        input.addEventListener('keypress', (e) => {
            if (!/[0-9]/.test(e.key)) e.preventDefault();
        });
    });

    function syncAndMaybeSubmit() {
        const code = inputs.map(i => i.value).join('');
        hiddenInput.value = code;
        if (code.length === 6) {
            showLoading();
            form.submit();
        }
    }

    function showLoading() {
        codigoEl.style.opacity = '0.4';
        codigoEl.style.pointerEvents = 'none';
        loadingEl.style.display = 'flex';
    }

    // ── Resend form loading state ─────────────────────────────────────────────
    document.getElementById('resend-form').addEventListener('submit', function () {
        resendBtn.textContent = 'Enviando...';
        resendBtn.disabled    = true;
    });

    // Focus first input on load
    inputs[0].focus();
})();
</script>
</x-guest-layout>
