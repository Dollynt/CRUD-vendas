<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar cliente</title>
</head>
<body>
    <form method="POST" action="/clientes">
        @csrf

        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div>
            <label for="preco">Preço:</label>
            <input type="number" step="0.01" min="0" id="preco" name="preco" required>
        </div>

        <div>
            <label for="quantidade">Quantidade:</label>
            <input type="number" min="1" id="quantidade" name="quantidade" required>
        </div>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
