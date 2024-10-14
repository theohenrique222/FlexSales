@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')

<x-adminlte-datatable id="table" :heads="['ID', 'Nome', 'CPF', 'Ações']" theme="light" striped hoverable>
    @foreach ($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->cpf }}</td>
            <td>

                <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                    @csrf
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-info btn-sm">Editar</a>
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</x-adminlte-datatable>

<a class="btn btn-primary" href="{{ route('clients.create') }}">Cadastrar Cliente</a>

@stop
