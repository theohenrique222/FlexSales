@extends('adminlte::page')

@section('title', 'Vendedores')

@section('content_header')
    <h1>Vendedores</h1>
@stop

@section('content')

    <x-adminlte-datatable id="table" :heads="['Nome', 'E-mail', 'Ações']" theme="light" striped hoverable>
        @foreach ($sellers as $seller)
            <tr>
                <td>{{ $seller->user->name }}</td>
                <td>{{ $seller->user->email }}</td>
                <td>

                    <form action="{{ route('sellers.destroy', $seller->id) }}" method="post">
                        @csrf
                        <a href="{{ route('sellers.edit', $seller->id) }}" class="btn btn-info btn-sm">Editar</a>
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>


    <a class="btn btn-primary" href="{{ route('sellers.create') }}">Cadastrar Vendedor</a>

@stop
