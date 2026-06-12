<x-app-layout>
    <div class="favorites-wrapper">
        <h2 data-i18n="favorites.greeting" data-i18n-name="{{ auth()->user()?->name }}">Olá, {{ auth()->user()?->name }}! <br> Veja os seus produtos favoritos</h2><br>
        @if($favorites->isEmpty())
            <p data-i18n="favorites.empty">Você ainda não tem favoritos.</p>
        @else
            <div class="favorites-list">
                @foreach($favorites as $favorite)
                    <div class="favorite-item">
                        <h2>{{ $favorite->product->name }}</h2>
                        <p>{{ $favorite->product->description }}</p>
                        <p data-i18n="favorites.price" data-i18n-price="{{ number_format($favorite->product->price, 2) }}">Preço: R$ {{ number_format($favorite->product->price, 2) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
