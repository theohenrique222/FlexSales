@extends('adminlte::page')

@section('title', 'Venda')

@section('content_header')
    <h1>Venda</h1>
@stop

@section('content')
    <div class="container">
        <ul>
            <h3>Lista de Produtos</h3>
            @foreach ($products as $product)
                <li>Produto: {{ $product->name }}</li>
            @endforeach
        </ul>

        @foreach ($sales as $sale)
            <ul>
                <h3>Venda #{{ $sale->id }}</h3>
                @foreach ($sale->products as $product)
                    <li>
                        Produto: {{ $product->name }} <br>
                        Quantidade: {{ $product->pivot->quantity }}
                    </li>
                @endforeach
            </ul>
        @endforeach

        <ul>
            <h3>Lista de Clientes</h3>
            @foreach ($clients as $client)
                <li>{{ $client->name }}</li>
            @endforeach
        </ul>
    </div>

@stop
