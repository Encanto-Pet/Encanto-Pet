<x-app-layout>
    <div class="profile-overview">

        {{-- Saudação e cards de acesso rápido --}}
        <div class="profile-info">
            <h2 data-i18n="dashboard.greeting" data-i18n-name="{{ auth()->user()?->name }}">Olá, {{ auth()->user()?->name }}!</h2>
            <p data-i18n="dashboard.subtitle">Veja tudo sobre a sua conta Encanto.</p>
            <div class="update-profile">
                <i class="ph ph-pencil-simple-line"></i>
                <a href="{{ route('profile.edit') }}" data-i18n="dashboard.edit_data">Editar os seus dados</a>
            </div>
            <div class="account-actions">
                <a href="{{ route('orders.index') }}" class="account-card">
                    <div class="card-content">
                        <i class="ph ph-shopping-bag"></i>
                        <div>
                            <span data-i18n="dashboard.my_orders">Meus pedidos</span>
                            <small data-i18n="dashboard.my_orders_sub">Consulte os seus pedidos</small>
                        </div>
                    </div>
                    <span class="badge">{{ sprintf('%02d', $ordersCount) }}</span>
                </a>
                <a href="{{ route('favorites.index') }}" class="account-card">
                    <div class="card-content">
                        <i class="ph ph-heart"></i>
                        <div>
                            <span data-i18n="dashboard.favorites">Favoritos</span>
                            <small data-i18n="dashboard.favorites_sub">Compre os seus favoritos</small>
                        </div>
                    </div>
                    <span class="badge">{{ sprintf('%02d', $favoritesCount) }}</span>
                </a>
            </div>
        </div>

        {{-- Serviços Encanto Pet --}}
        <div class="pet-services">
            <div class="pet-content">
                <h2 data-i18n="dashboard.services_title">Serviços Encanto Pet</h2>
                <p data-i18n="dashboard.services_desc">O serviço que o seu pet merece!<br>No <span class="brand-highlight">Encanto Pet</span>, o seu amigo é a nossa prioridade. Conheça o nosso padrão de qualidade.</p>
                <div class="service-card">
                    <span data-i18n="dashboard.bath_grooming">Banho & Tosa</span>
                    <p data-i18n="dashboard.bath_desc">Conheça o nosso serviço e agende o banho do seu amigo!</p>
                    <button>
                        <a href="tel:+5511949622700" title="Agendar banho e tosa" data-i18n="dashboard.schedule_now">Agende Agora!</a>
                    </button>
                </div>
            </div>
        </div>

        {{-- Adote um pet --}}
        <div class="adotation-services">
            <div class="adotation-content">
                <h2 data-i18n="dashboard.adopt_title">Adote um pet!</h2>
                <p data-i18n="dashboard.adopt_desc">O Encanto Pet apoia o ato de adotar um pet, diante disso, que tal conhecer algumas ONG's que cuidam desse processo?</p>
                <div class="ong-grid">
                    <div class="ong-item">
                        <span class="ong-name" data-i18n="dashboard.ong1_name">Miados e Latidos</span>
                        <div class="ong-card">
                            <p data-i18n="dashboard.ong1_desc">Que tal adotar um gatinho?</p>
                            <button>
                                <a href="https://www.miadoselatidos.org.br/" target="_blank" rel="noopener" data-i18n="dashboard.learn_more">Conheça mais</a>
                            </button>
                        </div>
                    </div>
                    <div class="ong-item">
                        <span class="ong-name" data-i18n="dashboard.ong2_name">Canto da Terra</span>
                        <div class="ong-card">
                            <p data-i18n="dashboard.ong2_desc">Que tal adotar um cachorrinho?</p>
                            <button>
                                <a href="https://ongcantodaterra.org/" target="_blank" rel="noopener" data-i18n="dashboard.learn_more">Conheça mais</a>
                            </button>
                        </div>
                    </div>
                    <div class="ong-item">
                        <span class="ong-name" data-i18n="dashboard.ong3_name">ACãoChego</span>
                        <div class="ong-card">
                            <p data-i18n="dashboard.ong3_desc">Apadrinhe um pet!</p>
                            <button>
                                <a href="https://acaochego.org/QueroApadrinhar" target="_blank" rel="noopener" data-i18n="dashboard.learn_more">Conheça mais</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
