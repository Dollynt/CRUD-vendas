<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Vendas;
use App\Models\ProdutoVenda;
use App\Models\Parcela;
use Carbon\Carbon;


class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        $datahj = Carbon::now();
        $data = $datahj->addMonth()->format('Y-m-d');


        return view('vendas.cadastro_vendas', compact('clientes', 'produtos', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Retrieve all inputs from the form
        $cliente = $request->input('cliente');
        $produtos = $request->input('produtos');
        $quantidades = $request->input('quantidades');
        $valores = $request->input('valores');
        $valor_total = $request->input('valor_total');
        $forma_pagamento = $request->input('forma_pagamento');


        $venda = new Vendas;
        $venda->cliente_id = $cliente;
        $venda->valor_total = $valor_total;
        $venda->forma_pagamento = $forma_pagamento;

        if ($forma_pagamento == 'cartao_credito') {

            $parcelas = $request->input('parcelas');
            $venda->parcelas = $parcelas;
            $valor_parcela = $valor_total / $parcelas;
            $venda->valor_parcela = $valor_parcela;
            $datas = $request->input('datas');

            for ($i = 0; $i < count($datas); $i++) {
                $parcela = new Parcela;
                $parcela->valor = $valor_parcela;
                //$parcela->data_vencimento = $datas[$i];
                $venda->parcelas()->save($parcela);
            }
        }

        for ($i = 0; $i < count($produtos); $i++) {
            $produto = new ProdutoVenda;
            $produto->produto_id = $produtos[$i];
            $produto->quantidade = $quantidades[$i];
            $produto->valor = $valores[$i];
            $venda->produtos()->save($produto);
        }

        $venda->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
