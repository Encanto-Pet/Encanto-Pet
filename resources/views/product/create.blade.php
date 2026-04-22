<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Produto</title>
    <link rel="stylesheet" href="{{ asset('css/products/create.style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="forms">
            <h2>Olá, Adm! 👋</h2>
            <p>Cadastre mais produtos.</p>
            <form id="productForm" action="/product/store" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" id="name" placeholder="Nome do Produto" required>
                <textarea name="description" id="description" placeholder="Descrição"></textarea>
                <input type="number" name="price" id="price" placeholder="Preço" step="0.01">
                <input type="text" name="category" id="category" placeholder="Categoria">
                
                <label for="image" class="label-file">Faça o upload da foto do produto</label>
                <input type="file" name="image" id="image" accept="image/*">

                <button type="submit" class="btn-salvar">Salvar Produto</button>
            </form>
        </div>

        <div id="lista-produtos" class="cards-container">
            </div>
    </div>

    <script>
        // Lógica para criar o card visualmente antes mesmo de recarregar a página
        document.getElementById('image').addEventListener('change', function(e) {
            const container = document.getElementById('lista-produtos');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const nome = document.getElementById('name').value || "Nome do Produto";
                    const preco = document.getElementById('price').value || "0.00";
                    const categoria = document.getElementById('category').value || "Categoria";

                    // Limpa o container para mostrar apenas o "preview" atual ou acumular
                    const cardHTML = `
                        <div class="card-produto">
                            <img src="${event.target.result}" alt="Preview">
                            <h3>${nome}</h3>
                            <p class="preco">R$ ${parseFloat(preco).toFixed(2)}</p>
                            <p style="font-size: 0.8rem; color: #888;">${categoria}</p>
                        </div>
                    `;
                    container.innerHTML = cardHTML;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>