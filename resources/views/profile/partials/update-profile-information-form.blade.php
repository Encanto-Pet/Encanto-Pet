<section class="edit-box">
    
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')
        <h3>Dados do Usuário</h3>
        <div class="input-group">
            <label for="name" :value="__('Name')" >Nome</label>
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="input-group">
            <label for="email" :value="__('Email')">Email</label>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="email-verification">
                        {{ __('O seu e-mail não está verificado') }}

                        <button form="send-verification" class="bttn-verification">
                            {{ __('Clique aqui para reenviar a verificação para o seu e-mail') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="new-verification-link">
                            {{ __('Um novo link de verificação foi enviado para o seu e-mail') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <button type="submit" class="save-btn">
                Salvar alterações
            </button>
            <a href="{{ route('dashboard') }}" class="back-btn">Voltar</a>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
