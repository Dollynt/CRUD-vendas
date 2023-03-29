<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Vendas</title>
</head>
<body>
    <h1>Cadastro de Vendas</h1>
    <form action="/vendas" method="POST">
        @csrf
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" onchange="atualizarEmail()">
            <option value="none">NONE</option>
            @foreach ($clientes as $client)
                <option value="{{ $client->id }}" data-valor="{{ $client->email }}">{{ $client->nome }}</option>
            @endforeach
        </select>
        <span id='email'></span>

        <h2>Itens da Venda</h2>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><select name="produtos[]" id="produtos-select" onchange="atualizarValor()">
                        <option value="none">NONE</option>
                            @foreach ($produtos as $product)
                                <option value="{{ $product->id }}" data-valor="{{ $product->preco }}">{{ $product->nome }}</option>
                            @endforeach
                    </select></td>
                    <td><input type="number" name="quantidades[]"></td>
                    <td><span name="valores[]" id="valor-input"></span></td>
                </tr>
            </tbody>
        </table>

        <label for="forma_pagamento">Forma de Pagamento:</label>
        <select id="forma_pagamento" name="forma_pagamento">
            <option value="dinheiro">Dinheiro</option>
            <option value="cartao_credito">Cartão de Crédito</option>
            <option value="cartao_debito">Cartão de Débito</option>
        </select>

        <label for="parcelas">Número de Parcelas:</label>
        <input type="number" id="parcelas" name="parcelas" min="1" max="12">

        <h2>Parcelas</h2>
        <table>
            <thead>
                <tr>
                    <th>Data de Vencimento</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="date" name="datas[]"></td>
                    <td><input type="number" step="0.01" name="parcela_valores[]"></td>
                </tr>
            </tbody>
        </table>

        <button type="submit">Cadastrar Venda</button>
    </form>

    <script>
        function atualizarValor() {
            var produtosSelect = document.getElementById("produtos-select");
            var valorSpan = document.getElementById("valor-input");

            var produtoValor = produtosSelect.options[produtosSelect.selectedIndex].getAttribute("data-valor");
            valorSpan.innerText = produtoValor;


        }

        function atualizarEmail() {
            var clienteSelect = document.getElementById("cliente");
            var emailSpan = document.getElementById("email");

            var emailCliente = clienteSelect.options[clienteSelect.selectedIndex].getAttribute("data-valor");
            emailSpan.innerText = emailCliente;


        }
    </script>
</html>

