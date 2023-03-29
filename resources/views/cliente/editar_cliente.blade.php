<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar cliente</title>
</head>
<body>
    <form method="PUT" action="/editar_cliente/{{ $cliente->id }}">
        @csrf

        <div>
            <label for="nome">{{ $cliente->nome }}</label>
            <input type="text" id="nome" name="nome" placeholder="{{ $cliente->nome }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  placeholder="{{ $cliente->email }}" required>
        </div>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
