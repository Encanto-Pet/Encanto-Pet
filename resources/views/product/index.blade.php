<a href="/product/create">Olá, Adm!</a>
<p>Cadastre mais produtos e aumente a sua variedade.</p>
<table border="1">
    <tr>
        <th>Id Produto</th>
        <th>Nome do Produto</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    @foreach($product as $p)
    <tr>
        <td>{{$p->id}}</td>
        <td>{{$p->name}}</td>
        <td>{{$p->description}}</td>
        <td>{{$p->price}}</td>
        <td>{{$p->category}}</td>
        <td><a href="/product/edit/{{$p->id}}">Editar</a>
        |<a href="/product/delete/{{$p->id}}">Deletar</a></td>
    <tr>
    @endforeach
</table>    

