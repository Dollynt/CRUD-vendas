<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente/lista_clientes', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente/cadastro_cliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'nullable|email'

        ]);

        $cliente = new Cliente;
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->created_at = now();
        $cliente->save();

        return response()->json([
            'nome'         => $cliente->nome,
            'email'        => $cliente->email,
            'registeredAt' => $cliente->created_at
        ], 201);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente){
            return response()->json([
                'error' => [
                    'message' => 'Client not found'
                ]
            ], 404);
        }


        return view('cliente.editar_cliente', compact('cliente'));
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
        $request->validate([
            'nome' => 'required',
            'email' => 'nullable|email'

        ]);

        $cliente = Cliente::firstWhere('id', $id);
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->save();



        return response()->json([
            'nome'         => $cliente->nome,
            'email'        => $cliente->email,
            'registeredAt' => $cliente->created_at
        ], 200);
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
