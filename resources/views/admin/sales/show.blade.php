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
                                    <th>Valor</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($sale->products as $product)
                                    @php
                                        $subtotal = $product->price * $product->pivot->quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                        <td>{{ number_format($product->price, 2, ',', '.') . ' R$' }}</td>
                                        <td>{{ number_format($subtotal, 2, ',', '.') . ' R$' }}</td>
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
                <div class="container">
                    <x-adminlte-select name="optionsTest1" label="Forma de pagamento" igroup-size="sm">
                        <x-adminlte-options :options="['A Vísta', 'Parcelado', 'Parcelamento Personalizado']" empty-option="Selecione a forma de pagamento" />
                    </x-adminlte-select>

                    <x-adminlte-select name="optionsTest1" label="Opções de parcelamento" igroup-size="sm">
                        <x-adminlte-options :options="['1x'], ['2x']" empty-option="Quantidade de parcelas" />
                    </x-adminlte-select>
                    
                </div>
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
