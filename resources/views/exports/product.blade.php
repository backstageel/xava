<table >
    <thead>
    <tr>
        <th>id</th>
        <th>Referencia</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Data a criação</th>

    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->reference}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{ isset($product->ProductCategory) ? $product->ProductCategory->name : '' }}</td>
            <td>{{$product->brand}}</td>
            <td>{{$product->created_at}}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    </tfoot>
</table>
