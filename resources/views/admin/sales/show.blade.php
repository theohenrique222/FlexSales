@extends('adminlte::page')

@section('title', 'Detalhes da Venda')

@section('content_header')
    <h1 class="text-center">Detalhes da Venda</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Venda Nº {{ $sale->id }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor Unitário</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                        <td>{{ number_format($product->price, 2, ',', '.') . ' R$' }}</td>
                                        <td>{{ number_format($product->price * $product->pivot->quantity, 2, ',', '.') . ' R$' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Total da Venda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($total, 2, ',', '.') . ' R$' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div>
                <h3>Pagamento</h3>
            </div>

            <div class="col-md-12">
                <form action="{{ route('payments.edit', $sale->id) }}" method="get">
                    <x-adminlte-button class="btn-flat" type="submit" label=" Prosseguir pagamento" theme="success"
                        icon="fas fa-lg fa-credit-card" />
                </form>
            </div>

            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-info">
                            <th>Cliente</th>
                            <th>Vendedor</th>
                        </tr>
                    </thead>
                    <div class="card-body">
                        <tbody>
                            <tr class="bg-white">
                                <td><i class="fas fa-users mr-2"></i> {{ $sale->client->name }}</td>
                                <td><i class="fas fa-user mr-2"></i>{{ $sale->seller->user->name }}</td>
                            </tr>
                        </tbody>
                    </div>
                </table>
            </div>
        </div>
    </div>
@stop
