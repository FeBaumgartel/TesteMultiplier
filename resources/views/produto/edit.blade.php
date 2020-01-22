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
                    <form action="{{route('produto.update', $produto['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        Nome: <input type="text" name="nome" value="{{$produto['nome']}}"><br>
                        Preço: <input type="text" name="preco" value="{{$produto['preco']}}"><br>
                        Peso: <input type="text" name="peso" value="{{$produto['peso']}}"><br>
                        <input type="submit" value="salvar">
                    </form>
                    <a href="{{route('produto.index')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection