console.log('oi')
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
    console.log(numRows)
    for (let row = 1; row <= numRows; row++) {

        var spanId = "valor-input-" + row;
        var valor = parseFloat(document.getElementById(spanId).innerText)
        valorTotal += valor
    }
    console.log(valorTotal)
    totalDisplay.innerText = valorTotal


}

function voltar() {
    const selectProdutosForm = document.getElementById("select-produtos");
    const pagamentoForm = document.getElementById("pagamento");

    selectProdutosForm.style.display = "block";
    pagamentoForm.style.display = "none";
}
