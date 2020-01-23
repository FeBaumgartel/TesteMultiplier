<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    public function Teste(){
        return response()->json(["data"=>Produto::onlyTrashed()->get()]);
    }
}
