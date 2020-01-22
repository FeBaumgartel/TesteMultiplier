@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informações do Produto</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>ID: {{$produto["id"]}}</p>
                    <p>Nome: {{$produto["nome"]}}</p>
                    <p>Preco: {{$produto["preco"]}}</p>
                    <p>Peso: {{$produto["peso"]}}</p>
                    <br>

                    <a href="{{route('produto.index')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection