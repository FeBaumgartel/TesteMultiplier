<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoProduto extends Model
{
    use SoftDeletes;
    protected $table = 'pedido_produtos';
    protected $fillable = ['produto_id','pedido_id','quantidade'];
}