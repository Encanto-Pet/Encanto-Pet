<x-app-layout>
    <div class="profile-overview">
        <div class="profile-info">
            <h2>Olá, {{ auth()->user()?->name }}!</h2>
            <p>Veja tudo sobre a sua conta Encanto.</p>
                <div class="update-profile" alt="Atualizar perfil">
                    <i class="ph ph-pencil-simple-line"></i>
                    <a href="{{ route('profile.edit') }}">Editar os seus dados</a>
                </div>  
        </div>
    </div>
</x-app-layout>