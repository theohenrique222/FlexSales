@extends('adminlte::page')

@section('title', 'Venda')

@section('content_header')
    <h1>Venda</h1>
@stop

@section('content')
    <div>
        <form action="{{ route('sales.update', $sale->id) }}" method="post">
            @csrf
            @method('put')

            <div class="row">
                <x-adminlte-select name="client_id" label="Cliente" label-class="text-lightblue" fgroup-class="col-md-6"
                    data-placeholder="Selecione o Cliente">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>

                    <x-adminlte-options :selected="$sale->client_id" :options="$clients->pluck('name', 'id')->toArray()" />

                </x-adminlte-select>
            </div>

            <div class="row">
                <x-adminlte-select name="product_id" label="Produtos" label-class="text-lightblue" fgroup-class="col-md-6"
                    data-placeholder="Selecione o Produto">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>

                    <x-adminlte-options :options="$products->pluck('name', 'id')->toArray()" />

                </x-adminlte-select>

                <div class="col-md-2">
                    <form action="{{ route('sales.edit', $sale->id) }}" method="post">
                        @csrf
                        <x-adminlte-input class="mr-2" name="quantity" label="Quantidade" placeholder="Quantitade"
                            label-class="text-lightblue">
                            <x-slot name="appendSlot">
                                <x-adminlte-button type="submit" theme="warning" icon="fas fa-plus" />
                            </x-slot>
                        </x-adminlte-input>
                    </form>


                </div>



            </div>

            <x-adminlte-button class="btn-flat" type="submit" label="Iniciar Venda" theme="success"
                icon="fas fa-lg fa-save" />
        </form>

    </div>



@stop
