@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Clientes</h1>
@stop

@section('content')
    <form action="{{ route('clients.update', $client->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <x-adminlte-input name="name" label="Nome" placeholder="Nome do Cliente" fgroup-class="col-md-6"
                disable-feedback value="{{ $client->name }}"/>
        </div>

        <div class="row">
            <x-adminlte-input name="cpf" label="CPF" placeholder="CPF do cliente" type="number" fgroup-class="col-md-6" value="{{ $client->cpf }}">
                <x-slot name="appendSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-hashtag"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>
        

        <x-adminlte-button class="btn-flat" type="submit" label="Editar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop