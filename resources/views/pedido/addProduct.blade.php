@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Produto</div>
                <div class="card-body" style="height:320px">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{route('pedido.addProduct')}}" method="POST">
                        @csrf
                        <input type="hidden" name="pedido_id" value="{{$pedido['id']}}" readonly=“true”><br>
                        Produto:
                        <select class="form-control" id="exampleFormControlSelect1" style="width:200px" name="produto_id">
                            @foreach($produtos as $p)
                            <option value="{{$p->id}}">{{$p['nome']}}</option>
                            @endforeach
                        </select>
                        Quantidade: <input type="text" name="quantidade"><br>

                        <input type="submit" value="salvar">
                    </form>

                    <a href="{{route('pedido.index')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection