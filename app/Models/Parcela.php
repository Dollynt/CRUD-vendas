<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    protected $fillable = ['valor', 'data_vencimento'];

    public function venda()
    {
        return $this->belongsTo('App\Models\Venda');
    }
}
