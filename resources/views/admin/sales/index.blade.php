@extends('adminlte::page')

@section('title', 'Vendas')

@section('content')
    <div class="container">
        <h1>Todas as Vendas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Data da Venda</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>
                            {{ $sale->id }}
                        </td>
                        <td>
                            {{ $sale->client->name }}
                        </td>
                        <td>
                            {{ $sale->seller->user->name }}
                        </td>
                        <td>
                            {{ $sale->created_at->format('d/m/Y ' . ' | ' . ' H:m:s') }}
                        </td>
                        <td>
                            {{ $sale->payments ? 'R$ ' . number_format($sale->payments->amount, 2, ',', '.') : 'ERRO' }}
                        </td>
                        <td>
                            <form action="{{ route('sales.update', $sale->id) }}" method="post">
                                @csrf
                                @method('put')

                                <x-adminlte-modal id="modalPurple" title="Theme Purple" theme="primary" icon="fas fa-bolt"
                                    size='lg' disable-animations>
                                    <h1>Detalhes da Venda</h1>
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
                                                                        <td>{{ number_format($product->price, 2, ',', '.') . ' R$' }}
                                                                        </td>
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
                                                                    <th>Forma de pagamento</th>
                                                                    <th>Prestações</th>
                                                                    <th>Valor da parcela</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    {{-- <td>{{ number_format($total, 2, ',', '.') . ' R$' }}</td> --}}
                                                                    <td>Erro</td>
                                                                    <td>{{ $sale->payments->payment_method ?? '' }}</td>
                                                                    <td>{{ $sale->payments->installments ?? '' }}</td>
                                                                    <td>{{ $sale->payments->formatted_installment_values ?? '' }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-adminlte-modal>

                                <button type="button" data-toggle="modal" data-target="#modalPurple"
                                    data-sale-id="{{ $sale->id }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Eye">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#modalPurple').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget); // Botão que acionou a modal
                let saleId = button.data('sale-id'); // ID da venda
                let clientName = button.data('client-name'); // Nome do cliente
                let sellerName = button.data('seller-name'); // Nome do vendedor
                let paymentMethod = button.data('payment-method'); // Método de pagamento
                let installments = button.data('installments'); // Parcelas

                // Atualizar os elementos dentro da modal
                $("#saleIdText").text(saleId);
                $("#clientName").text(clientName);
                $("#sellerName").text(sellerName);
                $("#paymentMethod").text(paymentMethod);
                $("#installments").text(installments);

                // Atualizar o link da venda
                $("#saleLink").attr("href", "/sales/" + saleId);
            });
        });
    </script>
@stop
