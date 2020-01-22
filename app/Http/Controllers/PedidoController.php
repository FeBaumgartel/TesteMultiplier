<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Pedido;
use App\PedidoProduto;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedido.index', compact(['pedidos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();
        return view('pedido.create', compact(['produtos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedido = new Pedido();
        $pedido->status = $request->status;
        $pedido->valorTotal = 0;
        $pedido->pesoTotal = 0;
        $pedido->quantidadeTotal = 0;
        $pedido->cliente = $request->cliente;
        $pedido->save();


        return redirect()->route("pedido.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);
        $pedidoProduto = PedidoProduto::select('produto_id')->where('pedido_id', $id)->get();
        $produto = Produto::whereIn('id', $pedidoProduto)->get();

        return view("pedido.info")->with('pedido', $pedido)->with('produto', $produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);

        return view("pedido.edit", compact(['pedido']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pedido = Pedido::find($id);
        if ($pedido == null)
            $pedido = new Pedido();
        $pedido->status = $request->status;
        $pedido->cliente = $request->cliente;
        $pedido->valorTotal = $request->valorTotal;
        $pedido->quantidadeTotal = $request->quantidadeTotal;
        $pedido->pesoTotal = $request->pesoTotal;
        $pedido->save();

        return redirect()->route("pedido.index");
    }

    public function finalizarPedido($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido == null)
            $pedido = new Pedido();
        $pedido->status = "pedido";
        $pedido->save();

        return redirect()->route("pedido.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pedido::destroy($id);

        return redirect()->route("pedido.index");
    }

    public function addProduct(Request $request)
    {
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $request->pedido_id;
        $pedidoProduto->produto_id = $request->produto_id;
        $pedidoProduto->quantidade = $request->quantidade;

        $pedidoProduto->save();

        $pedidoProduto = PedidoProduto::where('pedido_id', $request->pedido_id)->get();
        $valorTotal = 0;
        $quantidadeTotal = 0;
        $pesoTotal = 0;
        foreach ($pedidoProduto as $pp) {
            $produto = Produto::find($pp->produto_id);
            $valorTotal += ($pp->quantidade * $produto->preco);
            $quantidadeTotal += $pp->quantidade;
            $pesoTotal += ($pp->quantidade * $produto->peso);
        }

        $pedido = Pedido::find($pp->pedido_id);
        $pedido->valorTotal = $valorTotal;
        $pedido->quantidadeTotal = $quantidadeTotal;
        $pedido->pesoTotal = $pesoTotal;
        $pedido->save();

        return redirect()->route("pedido.edit",$pp->pedido_id);
    }

    public function addProductIndex($id)
    {
        $pedido = Pedido::find($id);
        $produtos = Produto::all();

        return view("pedido.addProduct")->with('pedido', $pedido)->with('produtos', $produtos);
    }
}
