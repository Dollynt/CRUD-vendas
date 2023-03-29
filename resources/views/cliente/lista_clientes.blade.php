<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista clientes</title>
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
            <td>Email</td>
            <td>Data de criação</td>
        </tr>

        @foreach ($clientes as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->nome }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->created_at }}</td>
            <td><button type="button" onclick="window.location='{{ route("cliente.edit", ["id" => $client->id]) }}'">Editar cliente</button></td>
            <td>
                <form action="{{ route('cliente.destroy', ['id' => $client->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Deletar cliente</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
