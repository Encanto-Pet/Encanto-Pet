<form action="/product/update/{{$product->id}}" method="POST">
    @csrf
    <div>
        Nome do Produto: <input type="text" name="name" value="{{$product->name}}">
    </div>
    <div>
        Descrição: <textarea name="description">{{$product->description}}</textarea>
    </div>
    <div>
        Preço: <input type="number" name="price" value="{{$product->price}}" step="0.01">
    </div>
    <div>
        Categoria: <input type="text" name="category" value="{{$product->category}}">
    </div>
    <button type="submit">Editar Produto</button>
</form>
