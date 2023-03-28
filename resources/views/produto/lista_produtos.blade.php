<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista produtos</title>
</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Preço</td>
            <td>Quantidade</td>
        </tr>

        @foreach ($produtos as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->nome }}</td>
            <td>{{ $product->preco }}</td>
            <td>{{ $product->quantidade }}</td>
            <td><button type="button" onclick="window.location='{{ route("cliente.create") }}'">Editar produto</button></td>
            <td><button type="button" onclick="window.location='{{ route("cliente.create") }}'">Deletar produto</button></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
