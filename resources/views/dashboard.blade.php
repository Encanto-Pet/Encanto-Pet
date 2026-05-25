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
        <div class="pet-services">
            <img src="{{ asset('assets/img/cachorro na moto.svg') }}" alt="imagem de um cachorro em uma moto" class="pet-image">
            <div class="pet-content">
                <h2>Serviços Encanto Pet</h2>
                <p>O serviço que o seu pet merece <br> No <span>Encanto Pet</span>, o seu amigo é a nossa prioridade. Conheça o nosso padrão de qualidade </p>
                <div class="services">
                    <span>Banho & Tosa</span>
                    <p>Conheça o nosso serviço e agende o banho do seu amigo!</p>
                    <button>
                        <a href="#" alt="Número para agendar banho e tosa" >Agende Aqui!</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="adotation-services">
            <img src="{{ asset('assets/img/homem com cachorro.svg') }}" alt="imagem de um homem com um cachorro" class="pet-image">
            <div class="adotation-content">
                <h2>Adote um pet!</h2>
                <p>O Encanto Pet apoia o ato de adotar um pet, diante disso, que tal conhecer algumas ONG's que cuidam desse processo?</p>
                <div class="services">
                    <span>Miados e Latidos</span>
                    <div class="buttons">
                        <p>Que tal adotar um gatinho?</p>
                        <button>
                            <a href="https://www.miadoselatidos.org.br/" alt="ONG Miados e Latidos" >Conheça mais</a>
                        </button>
                    </div>
                    <span>Canto da Terra</span>
                    <div class="buttons">
                        <p>Que tal adotar um cachorrinho?</p>
                        <button>
                            <a href="https://ongcantodaterra.org/" alt="ONG Canto da Terra" >Conheça mais</a>
                        </button>
                    </div>
                    <span>ACãoChego</span>
                    <div class="buttons">
                        <p>Apadrinhe um pet!</p>
                        <button>
                            <a href="https://acaochego.org/QueroApadrinhar" alt="ONG ACãoChego" >Conheça mais</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>