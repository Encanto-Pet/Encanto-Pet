<section class="form-container">
    <header class="form-header">
        <h3>{{ __('Atualize a senha') }}</h3>
        <p>{{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para permanecer segura.') }}</p>
    </header>
    <form method="post" action="{{ route('password.update') }}" class="form-body">
        @csrf
        @method('put')

        <div class="input-group">
            <x-input-label for="update_password_current_password" :value="__('Senha atual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"  autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="input-group">
            <x-input-label for="update_password_password" :value="__('Nova Senha')" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')"  />
        </div>

        <div class="input-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Senha  ')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="form-actions">
            <x-primary-button class="btn-submit">{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
