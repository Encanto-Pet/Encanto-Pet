<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Encanto Pet</title>

    <!-- Fonte Baloo -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <div>
            <a href="/product/create" class="title">Olá, Adm! 👋</a>
            <p>Cadastre mais produtos e aumente a sua variedade.</p>
        </div>

        <div class="avatar">
            <img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt="Cachorro feliz">
        </div>
    </div>

    <!-- Cards resumo -->
    <div class="cards">
        <div class="card">
            <p>Produtos Cadastrados</p>
            <h2>{{ count($product) }}</h2>
        </div>

        <div class="card danger">
            <p>Produtos Arquivados</p>
            <h2>0</h2>
        </div>
    </div>

    <!-- Produtos -->
    <div class="section-header">
        <h3>Sua prateleira</h3>
        <a href="/product/create">Cadastre um novo produto</a>
    </div>

  
    <div class="products">
        @foreach($product as $p)
        <div class="product-card">
            <a href="{{ route('product.show', $p->id) }}" class="product-link" id="link-{{$p->id}}">
            <div class="product-card" id="product-{{$p->id}}">
                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}">
                <h4>{{ $p->name }}</h4>
                <span class="price">R$ {{ $p->price }}</span>
                <p class="category">{{ $p->category }}</p>
            </div>
            </a>

            <div class="actions">
                <a href="/product/edit/{{$p->id}}" class="edit">✏️</a>
                <a href="/product/delete/{{$p->id}}" class="delete">❌</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

</body>
</html>
