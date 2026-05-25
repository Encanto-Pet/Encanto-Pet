<x-app-layout>
    <div class="favorites-wrapper">
        <h2>Olá, {{ auth()->user()?->name }}! <br> Veja os seus produtos favoritos</h2><br>
        @if($favorites->isEmpty())
            <p>Você ainda não tem favoritos.</p>
        @else
            <div class="favorites-list">
                @foreach($favorites as $favorite)
                    <div class="favorite-item">
                        <h2>{{ $favorite->product->name }}</h2>
                        <p>{{ $favorite->product->description }}</p>
                        <p>Preço: R$ {{ number_format($favorite->product->price, 2) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
