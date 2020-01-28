<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Sincronizacao;

class ProdutoController extends Controller
{
    public function getProdutos()
    {
        return response()->json(["data" => Produto::all()->where([
            ['updated_at', '>=', Sincronizacao::max('sincronizacao')],
        ])]);
    }
    public function getDeletedProdutos()
    {
        return response()->json(["data" => Produto::onlyTrashed()->where([
            ['deleted_at', '>=', Sincronizacao::max('sincronizacao')],
        ])]);
    }

    public function postProdutos(Request $request)
    {
        foreach ($request->produtos as $p) {
            $produto = new Produto();
            $produto->nome = $p->nome;
            $produto->preco = $p->preco;
            $produto->peso = $p->peso;
            $produto->save();
        }

        return response()->json("Sucesso");
    }

    public function putProdutos($produtos)
    {
        $produto = Produto::find($produtos->id);
        $produto->nome = $produtos->nome;
        $produto->preco = $produtos->preco;
        $produto->peso = $produtos->peso;
        $produto->updated_at = $produtos->updated_at;
        $produto->save();
    }

    public function deleteProdutos($produtos)
    {
        Produto::delete($produtos->id);
    }
}
