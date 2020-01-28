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
        // saveSync();
    }
    
    public function getDeletedProdutos()
    {
        return response()->json(["data" => Produto::onlyTrashed()->where([
            ['deleted_at', '>=', Sincronizacao::max('sincronizacao')],
        ])]);
        // saveSync();
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
        // saveSync();

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
        // saveSync();
    }

    public function deleteProdutos(Request $request)
    {
        foreach ($request->produtos as $p) {
            Produto::delete($p->id);
        }
        // saveSync();
    }

    public function saveSync()
    {
        $sinc = new Sincronizacao();
        $sinc->sincronizacao = (new \DateTime())->format('Y-m-d H:i:s');
        $sinc->save();
    }
}
