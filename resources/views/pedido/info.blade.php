@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informações do Pedido</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <p>ID: {{$pedido["id"]}} | Cliente: {{$pedido["cliente"]}} | Status: {{$pedido["status"]}} | Valor Total: {{$pedido["valorTotal"]}} | Quantidade Total: {{$pedido["quantidadeTotal"]}} | Peso Total: {{$pedido["pesoTotal"]}}</p>
                    
                    @if(count($produto)>0)

                    <ul>
                        @foreach($produto as $p)
                        <li>{{$p['id']}} - {{$p['nome']}}</li>
                        @endforeach
                    </ul>

                    @else
                    <h4>Não existe produtos cadastrados</h4>
                    @endif

                    <a href="{{route('pedido.index')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection