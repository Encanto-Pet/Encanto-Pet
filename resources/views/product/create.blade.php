
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Produto</title>
</head>
<body>
    <div class="container">
        <div class="forms">
            <h2>Olá, Adm! 👋</h2>
            <p>Cadastre mais produtos.</p>
            <form action="/products/store" method="POST">
            @csrf
                <input type="text" id="nome" placeholder="Nome do Produto" required>
                <textarea id="descricao" placeholder="Descrição"></textarea>
                <input type="number" id="preco" placeholder="Preço" step="0.01">
                <input type="text" id="categoria" placeholder="Categoria">
                <input type="file" id="foto" accept="image/*">
                
                <button type="submit" class="btn-salvar">Salvar Produto</button>
            </form>
        </div>
        <div id="lista-produtos" class="cards-container">
            </div>
    </div>
</body>
</html>