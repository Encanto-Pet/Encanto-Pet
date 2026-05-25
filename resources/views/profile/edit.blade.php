<x-app-layout>
    <div class="profile-edit">
        <div class="profile-header">
            <div>
                <h2>Olá, {{ auth()->user()->name }}!</h2>
                <h3>Edite seus dados.</h3>
                <p>
                    Mantenha seus dados sempre atualizados,
                    assim você não fica por fora das novidades.
                </p>
            </div>
            <br>
        <div class="forms-container">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>