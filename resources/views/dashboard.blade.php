<x-app-layout>
    <div class="profile-overview">
        <div class="profile-info">
            <h2>Olá, {{ auth()->user()?->name }}!</h2>
            <p>Veja tudo sobre a sua conta Encanto.</p>
            <div class="update-profile" alt="Atualizar perfil">
                <i class="ph ph-pencil-simple-line"></i>
                <a href="{{ route('profile.edit') }}">Editar os seus dados</a>
            </div> 
            <div class="account-actions">
                <a href="{{ route('orders.index') }}" class="account-card">
                    <div class="card-content">
                        <i class="ph ph-shopping-bag"></i>
                        <div>
                            <span>Meus pedidos</span>
                        </div>
                    </div>
                    <span class="badge">{{ sprintf('%02d', $ordersCount) }}</span>
                </a>
                <a href="{{ route('favorites.index') }}" class="account-card">
                    <div class="card-content">
                        <i class="ph ph-heart"></i>
                        <div>
                            <span>Meus Favoritos</span>
                        </div>
                    </div>
                    <span class="badge">{{ sprintf('%02d', $favoritesCount) }}</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>