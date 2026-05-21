<section class="delete-perfil-container">
    <header>
        <h3>
            {{ __('Deletar a conta') }}
        </h3>

        <p>
            {{ __('Uma vez que sua conta é deletada, todos os seus recursos e dados serão permanentemente excluídos. Antes de deletar sua conta, por favor, baixe qualquer dado ou informação que você deseja reter.') }}
        </p>
    </header>

    <button class="btn-delete"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Deletar Conta') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="confirm-delete">
            @csrf
            @method('delete')

            <h3>
                {{ __('Tem certeza de que deseja excluir sua conta?') }}
            </h3>

            <p >
                {{ __('Uma vez que sua conta é deletada, todos os seus recursos e dados serão permanentemente excluídos. Por favor, insira sua senha para confirmar que você deseja excluir sua conta permanentemente.') }}
            </p>

            <div >
                <x-input-label for="password" value="{{ __('Password') }}" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')"  />
            </div>

            <div>
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Deletar Conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
