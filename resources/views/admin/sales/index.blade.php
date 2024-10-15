@extends('adminlte::page')

@section('title', 'Vendas')

@section('content_header')
    <h1>Vendas</h1>
@stop

@section('content')


    <div>
        <form action="{{ route('sellers.store') }}" method="post">
            @csrf
            @method('post')

            <div class="row">
                <x-adminlte-select2 name="seler" label="Vendedor" label-class="text-lightblue" fgroup-class="col-md-6"
                    data-placeholder="Selecione o vendedor">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                    <x-adminlte-options :options="$sellers->pluck('id')" empty-option />
                </x-adminlte-select2>
            </div>

            <div class="row">
                <x-adminlte-select2 name="client" label="Cliente" label-class="text-lightblue" fgroup-class="col-md-6"
                    data-placeholder="Selecione o Cliente">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>
                    <x-adminlte-options :options="$clients->pluck('name')->toArray()" empty-option />
                </x-adminlte-select2>
            </div>


            <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save" />
        </form>

        


    </div>



@stop
