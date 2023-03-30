<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $fillable = ['cliente_id', 'valor_total', 'forma_pagamento', 'parcelas', 'valor_parcela'];

    public function produtos()
    {
        return $this->hasMany('App\Models\ProdutoVenda');
    }

    public function parcelas()
    {
        return $this->hasMany('App\Models\Parcela');
    }
}
