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
                    <br>
                    <div style="overflow-y:auto;position:absolute;top:55px;right:10px;width:200px;max-height:300px;margin:0px;padding:0px;border-style: solid;">
                        <p>Produtos Cadastrados</p>
                        @if(count($produtos)>0)

                        <ul>
                            @foreach($produtos as $p)
                            <li>{{$p['id']}} - {{$p['nome']}}</li>
                            @endforeach
                        </ul>

                        @else
                        <h4>Não existe produtos cadastrados</h4>
                        @endif
                    </div>

                    <a href="{{route('pedido.index')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection