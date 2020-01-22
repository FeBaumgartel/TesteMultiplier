@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pedidos</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <a href="{{route('pedido.create')}}">NOVO PEDIDO</a>
                    @if(count($pedidos)>0)
                    <ul>
                        @foreach($pedidos as $p)
                        <li>ID: {{$p["id"]}} | Cliente: {{$p["cliente"]}}
                            | <a href="{{route('pedido.edit', $p['id'])}}">Edit</a>
                            | <a href="{{route('pedido.show', $p['id'])}}">Info</a>
                            | <a href="{{route('pedido.finalizarPedido', $p['id'])}}">Finalizar</a>
                            | <form action="{{route('pedido.destroy', $p['id'])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Deletar">
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <h4>Não existe pedidos cadastrados</h4>
                    @endif
                    <a href="{{route('home')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection