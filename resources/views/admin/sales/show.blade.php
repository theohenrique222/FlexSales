@extends('adminlte::page')

@section('title', 'Detalhes da Venda')

@section('content_header')
    <h1 class="text-center">Detalhes da Venda</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                <div class="card card-primary mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Venda {{ $sale->id }}</h3>
                    </div>
                    <div class="card-body">
                        <h4>Produtos nesta venda</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                        <td>{{ $product->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card card-info mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Clientes</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($clients as $client)
                                <li class="list-group-item">
                                    <i class="fas fa-user mr-2"></i> {{ $client->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Vendedor</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($sellers as $seller)
                                <li class="list-group-item">
                                    <i class="fas fa-box mr-2"></i> {{ $seller->user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
