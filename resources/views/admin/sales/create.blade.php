@extends('adminlte::page')

@section('title', 'Vendas')

@section('content_header')
    <h1>Vendas</h1>
@stop

@section('content')

    <div>
        <form action="{{ route('sales.store') }}" method="post">
            @csrf
            @method('post')

            <div class="row">
                <x-adminlte-select2 name="client_id" label="Cliente" label-class="text-lightblue" fgroup-class="col-md-6"
                    data-placeholder="Selecione o Cliente">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>
                    <x-adminlte-options :options="$clients->pluck('name', 'id')->toArray()" />
                </x-adminlte-select2>
            </div>
            <x-adminlte-button class="btn-flat" type="submit" label="Iniciar Venda" theme="success"
                icon="fas fa-lg fa-arrow-right" />
        </form>
    </div>



@stop
