<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Vendas</title>

    <style>
        #pagamento {
            display: none;
        }

        #not-credito {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Vendas</h1>
    <form action="/vendas" method="POST">
        @csrf
        <div id="select-produtos">
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" onchange="atualizarEmail()">
            <option value="none">NONE</option>
            @foreach ($clientes as $client)
                <option value="{{ $client->id }}" data-valor="{{ $client->email }}">{{ $client->nome }}</option>
            @endforeach
        </select>
        <span id='email'></span>

        <h2>Itens da Venda</h2>
        <table id="itens-venda">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><select name="produtos[]" id="produtos-select-1" onchange="atualizarValor(this)">
                        <option value="none">NONE</option>
                            @foreach ($produtos as $index => $product)
                                <option value="{{ $product->id }}" data-valor="{{ $product->preco }}">{{ $product->nome }}</option>
                            @endforeach
                    </select></td>
                    <td><input type="number" min="0" name="quantidades[]" id="quantidades-1" onchange="atualizarValorQtd(this)"></td>
                    <td><span name="valores[]" id="valor-input-1">0</span></td>


                </tr>
            </tbody>
        </table>
        <button type="button" onclick="adicionarItem()">Adicionar novo produto</button>
        <button type="button" onclick="continuar()">Continuar</button><br>
    </div>


    <div id="pagamento">
        <p>Valor Total: R$ <span id="valor-total"></span></p>

        <label for="forma_pagamento">Forma de Pagamento:</label>
        <select id="forma_pagamento" name="forma_pagamento" onchange="formaPagamento()">
            <option value="dinheiro" selected>Dinheiro</option>
            <option value="cartao_credito">Cartão de Crédito</option>
            <option value="cartao_debito">Cartão de Débito</option>
        </select>

        <div id="not-credito">
            <label for="parcelas">Número de Parcelas:</label>
            <input type="number" min="1" max="12" id="parcela_valores" value="1" onchange="atualizarParcelas()">

                <h2>Parcelas</h2>
                <table id="parcelas-table">
                   <thead>
                        <tr>
                            <th>Data de Vencimento</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="date" value="{{ $data }}" id="data-vencimento-1" onchange="atualizarData()"></td>
                            <td><input type="number" id="valor-parcela-por-data-1"></td>
                        </tr>
                    </tbody>
                </table>
        </div>
        <button type="button" onclick="voltar()">Voltar</button>
        <button type="submit">Cadastrar Venda</button>

    </div>
    </form>

</body>
<script>

    function atualizarData() {
        var data = document.getElementById('data-vencimento-1')
    }

    function atualizarParcelas() {
        var parcelasInput = document.getElementById('parcela_valores').value
        var parcelasTable = document.getElementById('parcelas-table');
        var data = document.getElementById('data-vencimento-1').value
        var valorTotal = parseFloat(document.getElementById('valor-total').innerHTML)
        var valorParcela = parseFloat(valorTotal / parcelasInput)
        console.log(valorParcela)

        var numRows = parcelasTable.rows.length -1;


        if (parcelasInput >= numRows) {

            for (var i = numRows; i < parcelasInput; i++) {

            var row = parcelasTable.insertRow();
            var dataCell = row.insertCell(0);
            var valorCell = row.insertCell(1);

            dataCell.innerHTML = '<input type="date" id="data-vencimento-'+ parseInt(i+1) + '"">';
            valorCell.innerHTML = '<input type="number" id="valor-parcela-por-data-'+ parseInt(i+1)+'"">';


            }
        } else if (parcelasInput < numRows) {

            for (var i = numRows - 1; i >= parcelasInput; i--) {
            parcelasTable.deleteRow(i);
            }
        }
        for (var i = 1; i < parcelasTable.rows.length; i++) {
        var valorParcelaInput = document.getElementById('valor-parcela-por-data-' + i);
        valorParcelaInput.value = valorParcela.toFixed(2);
        }

    }
    function formaPagamento() {
        var formaPagamentoSelect = document.getElementById("forma_pagamento");
        var selected = formaPagamentoSelect.options[formaPagamentoSelect.selectedIndex].getAttribute("value");
        var parcelas = document.getElementById('not-credito')
        if (selected != 'cartao_credito') {
            parcelas.style.display = "none"
        } else {
            parcelas.style.display = "block"
        }
    }

    function atualizarValorQtd(td) {
    var row = td.closest('tr');
    var produtoId = "produtos-select-" + row.rowIndex;
    var produto = document.getElementById(produtoId)
    var valor = produto.options[produto.selectedIndex].getAttribute("data-valor");
    var valorSpanId = "valor-input-" + row.rowIndex;
    var span = document.getElementById(valorSpanId)
    var total = td.value * valor
    span.innerHTML = total

}

function atualizarValor(produtosSelect) {
    var table = produtosSelect.closest('table');
    var numRows = table.rows.length;
    var row = produtosSelect.closest('tr');
    var valorSpanId = "valor-input-" + row.rowIndex;
    var valorSpan = document.getElementById(valorSpanId);

    var produtoValor = produtosSelect.options[produtosSelect.selectedIndex].getAttribute("data-valor");
    valorSpan.innerText = produtoValor;
}

function atualizarEmail() {
    var clienteSelect = document.getElementById("cliente");
    var emailSpan = document.getElementById("email");

    var emailCliente = clienteSelect.options[clienteSelect.selectedIndex].getAttribute("data-valor");
    emailSpan.innerText = emailCliente;
}

function adicionarItem() {
    var tabela = document.getElementById("itens-venda");
    var linha = tabela.insertRow(-1);
    var celulaProduto = linha.insertCell(0);
    var celulaQuantidade = linha.insertCell(1);
    var celulaValor = linha.insertCell(2);


    var valorSpan = document.createElement("span");
    var valorSpanId = "valor-input-" + linha.rowIndex;
    valorSpan.id = valorSpanId;


    var produtosSelect = document.createElement("select");
    produtosSelect.id = "produtos-select-" + linha.rowIndex;
    produtosSelect.onchange = function() {atualizarValor(produtosSelect);}
    produtosSelect.innerHTML = `
        <option value="none">NONE</option>
        @foreach ($produtos as $product)
            <option value="{{ $product->id }}" data-valor="{{ $product->preco }}">{{ $product->nome }}</option>
        @endforeach
    `;

    var quantidadeInput = document.createElement("input");
    quantidadeInput.type = "number";
    quantidadeInput.id = "quantidades-" + linha.rowIndex;
    quantidadeInput.onchange = function() {atualizarValorQtd(quantidadeInput);}



    celulaProduto.appendChild(produtosSelect);
    celulaQuantidade.appendChild(quantidadeInput);
    celulaValor.appendChild(valorSpan);
}

function continuar() {
    const selectProdutosForm = document.getElementById("select-produtos");
    const pagamentoForm = document.getElementById("pagamento");

    selectProdutosForm.style.display = "none";
    pagamentoForm.style.display = "block";

    var table = document.getElementById('itens-venda')
    var numRows = table.rows.length - 1;
    var totalDisplay = document.getElementById('valor-total')
    var valorTotal = 0
    var valorTotalParcela = document.getElementById('valor-parcela-por-data-1')
    for (let row = 1; row <= numRows; row++) {

        var spanId = "valor-input-" + row;
        var valor = parseFloat(document.getElementById(spanId).innerText)
        valorTotal += valor
    }
    console.log(valorTotal)
    totalDisplay.innerText = valorTotal
    valorTotalParcela.value = valorTotal


}

function voltar() {
    const selectProdutosForm = document.getElementById("select-produtos");
    const pagamentoForm = document.getElementById("pagamento");

    selectProdutosForm.style.display = "block";
    pagamentoForm.style.display = "none";
}

</script>
</html>

