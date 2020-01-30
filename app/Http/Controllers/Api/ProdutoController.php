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
        $id = 0;
        $produtos = json_decode($request->produtos, true);

        foreach ($produtos as $p) {
            if (is_null($p["id"])) {
                $produto = new Produto();
                $produto->nome = $p["nome"];
                $produto->preco = $p["preco"];
                $produto->peso = $p["peso"];
                $produto->save();
                $id=Produto::whereRaw('id = (select max(`id`) from produtos)')->get();
            } else {
                $id = $p["id"];
                $produto = Produto::find($p["id"]);
                $produto->nome = $p["nome"];
                $produto->preco = $p["preco"];
                $produto->peso = $p["peso"];
                $produto->save();
            }
        }

        return response()->json($id);
    }

    public function putProdutos(Request $request)
    {
        $produtos = json_decode($request->produtos, true);

        foreach ($produtos as $p) {
            $produto = Produto::find($p["id"]);
            $produto->nome = $p["nome"];
            $produto->preco = $p["preco"];
            $produto->peso = $p["peso"];
            $produto->updated_at = $p["updated_at"];
            $produto->save();
        }
    }

    public function deleteProdutos(Request $request)
    {
        $produtos = json_decode($request->produtos, true);

        foreach ($produtos as $p) {
            Produto::destroy($p["id"]);
        }
    }
}
