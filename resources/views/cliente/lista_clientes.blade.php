<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista clientes</title>
</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Data de criação</td>
        </tr>

        @foreach ($clientes as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->nome }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->created_at }}</td>
            <td><button type="button" onclick="window.location='{{ route("cliente.create") }}'">Editar cliente</button></td>
            <td><button type="button" onclick="window.location='{{ route("cliente.create") }}'">Deletar cliente</button></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
