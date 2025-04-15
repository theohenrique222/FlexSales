@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')

<x-adminlte-card title="Lista de Produtos" theme="primary" icon="fas fa-boxes" class="elevation-3">

    <x-adminlte-datatable id="table" :heads="['Nome', 'Marca', 'Quantidade', 'Valor (R$)', 'Estado', 'Ações']" theme="light" striped hoverable head-theme="bg-white">
        @forelse ($products as $product)
            <tr>
                <td class="align-middle">{{ $product->name }}</td>
                <td class="align-middle">{{ $product->brand }}</td>
                <td class="align-middle">{{ $product->quantity }}</td>
                <td class="align-middle">{{ number_format($product->price, 2, ',', '.') }}</td>
                <td class="align-middle">{{ $product->status === 'new' ? 'Novo' : 'Usado' }}</td>
                <td class="align-middle">
                    <div class="d-flex gap-1 mx-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Nenhum produto cadastrado.</td>
            </tr>
        @endforelse
    </x-adminlte-datatable>

    <div class="mt-3 text-end">
        <a class="btn btn-success" href="{{ route('products.create') }}">
            <i class="fas fa-plus"></i> Cadastrar Produto
        </a>
    </div>

</x-adminlte-card>



@stop
