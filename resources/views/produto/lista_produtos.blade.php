<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista produtos</title>
</head>
<body>
    @if(session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

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
            <td><button type="button" onclick="window.location='{{ route("produto.edit", ["id" => $product->id]) }}'">Editar produto</button></td>
            <td>
                <form action="{{ route('produto.destroy', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Deletar produto</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
