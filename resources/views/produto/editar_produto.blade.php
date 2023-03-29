<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar produto</title>
</head>
<body>
    <form method="PUT" action="/editar_produto/{{ $product->id }}">
        @csrf

        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="{{ $product->nome }}">
        </div>

        <div>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco"  placeholder="{{ $product->preco }}">
        </div>
        <div>
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade"  placeholder="{{ $product->quantidade }}">
        </div>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
