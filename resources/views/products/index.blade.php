<a href="/products/create">Criar uma Banda</a>
<table border="1">
    <tr>
        <th>Id Banda</th>
        <th>Banda</th>
        <th>Qtd. Cantores</th>
        <th>Ações</th>
    </tr>
    @foreach($bands as $b)
    <tr>
        <td>{{$b->id}}</td>
        <td>{{$b->name}}</td>
        <td>{{$b->Singers->count()}}</td>    
        <td><a href="/bands/edit/{{$b->id}}">Editar</a>
        |<a href="/bands/delete/{{$b->id}}">Deletar</a></td>
    <tr>
    @endforeach
</table>    