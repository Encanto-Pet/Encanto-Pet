<a href="/products/create">Olá, Adm!</a>
<p>Cadastre mais produtos e aumente a sua variedade.</p>

<form action="/products/store" method="POST">
    @csrf
    <div>
        Nome do produto: <input type="text" name="name">
        Descrição do produto: <input type="text" name="description">
        Preço do produto: <input type="number" name="price">
        Categoria do produto: <input type="text" name="category">
        Imagem do produto: <input type="text" name="image">
        Imagem do produto: <input type="text" name="image">
        Imagem do produto: <input type="text" name="image">
    </div>
    <button type="submit">Criar Produto</button>
</form>
