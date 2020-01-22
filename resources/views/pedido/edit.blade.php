@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alterar Produto</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{route('pedido.update', $pedido['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        Status: <input type="text" name="status" value="{{$pedido['status']}}" readonly=“true”><br>
                        Cliente: <input type="text" name="cliente" value="{{$pedido['cliente']}}"><br>
                        Valor Total: <input type="text" name="valor" value="{{$pedido['valorTotal']}}" readonly=“true”><br>
                        Peso Total: <input type="text" name="peso" value="{{$pedido['pesoTotal']}}" readonly=“true”><br>
                        Quantidade Total: <input type="text" name="quantidade" value="{{$pedido['quantidadeTotal']}}" readonly=“true”><br>
                        <input type="submit" value="salvar">
                    </form>
                    <a href="{{route('pedido.addProductIndex', $pedido['id'])}}">Adicionar Produto</a> | 
                    <a href="{{route('pedido.index')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection