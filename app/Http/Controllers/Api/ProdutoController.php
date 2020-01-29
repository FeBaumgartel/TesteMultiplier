<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Sincronizacao;
use Log;

class ProdutoController extends Controller
{
    public function getProdutos()
    {
        return response()->json(["data" => Produto::all()]);
    }

    public function getDeletedProdutos()
    {
        return response()->json(["data" => Produto::onlyTrashed()->get()]);
    }

    public function postProdutos(Request $request)
    {
        Log::debug($request);

        foreach ($request->produtos as $p) {
            $produto = new Produto();
            $produto->nome = $p["nome"];
            $produto->preco = $p["preco"];
            $produto->peso = $p["peso"];
            $produto->save();
        }

        return response()->json("Sucesso");
    }

    public function putProdutos(Request $request)
    {
        foreach ($request->produtos as $p) {
            $produto = Produto::find($p->id);
            $produto->nome = $p->nome;
            $produto->preco = $p->preco;
            $produto->peso = $p->peso;
            $produto->updated_at = $p->updated_at;
            $produto->save();
        }
    }

    public function deleteProdutos(Request $request)
    {
        foreach ($request->produtos as $p) {
            Produto::delete($p->id);
        }
    }
}
