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
                            {{ $sale->created_at->format('d/m/Y') }}
                        </td>
                        <td>
                            {{ 'R$ ' . number_format($sale->total, 2, ',', '.') }}
                        </td>
                        <td>
                            <form action="{{ route('sales.update', $sale->id) }}" method="post">
                                @csrf
                                @method('put')
                                <a href="{{ route('sales.show', $sale->id) }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@stop
