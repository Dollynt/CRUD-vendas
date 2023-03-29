<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar cliente</title>
</head>
<body>
    <form method="POST" action="{{ route('cliente.update', ['id' => $cliente->id]) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="nome">{{ $cliente->nome }}</label>
            <input type="text" id="nome" name="nome" value="{{ $cliente->nome }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  value="{{ $cliente->email }}" required>
        </div>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
