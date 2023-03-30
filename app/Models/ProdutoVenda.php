<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoVenda extends Model
{
    protected $fillable = ['produto_id', 'quantidade', 'valor'];

    public function venda()
    {
        return $this->belongsTo('App\Models\Venda');
    }
}
