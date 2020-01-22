@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Produtos</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <a href="{{route('produto.create')}}">NOVO PRODUTO</a>

                    @if(count($produtos)>0)

                    <ul>
                        @foreach($produtos as $p)
                        <li>{{$p['id']}} - {{$p['nome']}}
                            | <a href="{{route('produto.edit', $p['id'])}}">Edit</a>
                            | <a href="{{route('produto.show', $p['id'])}}">Info</a>
                            | <form action="{{route('produto.destroy', $p['id'])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Deletar">
                            </form>
                        </li>
                        @endforeach
                    </ul>

                    @else
                    <h4>Não existe produtos cadastrados</h4>
                    @endif
                    
                    <a href="{{route('home')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection