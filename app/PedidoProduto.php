<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $table = 'pedido_produtos';
    protected $fillable = ['produto_id','pedido_id','quantidade'];
}