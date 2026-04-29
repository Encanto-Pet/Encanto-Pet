 <link rel="stylesheet" href="{{ asset('css/products/show.style.css') }}">
<div class="product-detail-card">

    <!-- Imagem -->
    <div class="image-container">
        <button class="nav left">‹</button>

        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

        <button class="nav right">›</button>
    </div>

    <!-- Conteúdo -->
    <div class="product-info">

        <h2>{{ $product->name }}</h2>

        <p class="price">R$ {{ $product->price }}</p>

        <div class="rating">
            ⭐⭐⭐⭐⭐ <span>(131)</span>
        </div>

        <div class="category">
            <span>Categoria</span>
            <p>{{ $product->category }}</p>
        </div>

    </div>
</div>