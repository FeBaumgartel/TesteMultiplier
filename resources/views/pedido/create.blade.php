@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo Pedido</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{route('pedido.store')}}" method="POST">
                        @csrf
                        Status: <input type="text" name="status" value="orçamento" readonly=“true”><br>
                        Cliente: <input type="text" name="cliente"><br>
                                                
                        <input type="submit" value="salvar">
                    </form>                    
                    <a href="{{route('pedido.index')}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection