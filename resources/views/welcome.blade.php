<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>crud</title>

        <!-- Fonts -->

    </head>
    <body class="antialiased">
        <button type="button" onclick="window.location='{{ route("cliente.create") }}'">Criar cliente</button>
        <button type="button" onclick="window.location='{{ route("produto.create") }}'">Criar produto</button>
    </body>
</html>
