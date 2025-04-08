@extends('adminlte::page')

@section('title', 'Vendas')


@section('content_header')
    <h1>Todas as Vendas</h1>
@stop

@section('content')
    <div class="container">
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
                @forelse ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->client->name }}</td>
                        <td>{{ $sale->seller->user->name }}</td>
                        <td>{{ $sale->created_at->format('d/m/Y | H:i:s') }}</td>
                        <td>{{ $sale->payments ? 'R$ ' . number_format($sale->payments->amount, 2, ',', '.') : 'ERRO' }}
                        </td>
                        <td>

                            <button type="button" data-toggle="modal" data-target="#modalSale-{{ $sale->id }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Visualizar">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>

                            <x-adminlte-modal id="modalSale-{{ $sale->id }}" title="Detalhes da Venda" theme="primary"
                                icon="fas fa-bolt" size='lg' >
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3>Venda Nº {{ $sale->id }}</h3>
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
                                                                <td>{{ $sale->payments ? 'R$ ' . number_format($sale->payments->amount, 2, ',', '.') : 'ERRO' }}
                                                                </td>
                                                                <td>{{ $sale->payments->payment_method ?? 'N/A' }}</td>
                                                                <td>{{ $sale->payments->installments ?? '0' }}</td>
                                                                <td>{{ $sale->payments->formatted_installment_values ?? '0' }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
                                                                <td><i class="fas fa-users mr-2"></i>
                                                                    {{ $sale->client->name }}</td>
                                                                <td><i
                                                                        class="fas fa-user mr-2"></i>{{ $sale->seller->user->name }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-adminlte-modal>
                            
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir esta venda?');" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                    title="Deletar">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </form>


                            <a href="{{ route('sales.pdf', $sale->id) }}"
                                class="btn btn-xs btn-default text-success mx-1 shadow" title="Salvar em PDF" target="_Blanck">
                                <i class="fa fa-lg fa-fw fa-file-pdf"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhuma venda encontrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@stop
