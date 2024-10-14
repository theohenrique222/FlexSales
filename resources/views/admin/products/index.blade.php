@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')

    <x-adminlte-datatable id="table" :heads="['ID', 'Nome', 'Preço', 'Ações']" theme="light" striped hoverable>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>

                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        @csrf
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Editar</a>
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    <a class="btn btn-primary" href="{{ route('products.create') }}">Cadastrar Produto</a>


@stop
