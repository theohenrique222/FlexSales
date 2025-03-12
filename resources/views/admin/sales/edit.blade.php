@extends('adminlte::page')

@section('title', 'Venda')

@section('content_header')

    <h1>Vendas</h1>

@stop

@section('content')

    <div>
        <form action="{{ route('sales.update', $sale->id) }}" method="post">
            @csrf
            @method('put')

            <div class="row">
                <x-adminlte-select name="client_id" label="Cliente" fgroup-class="col-md-6"
                    data-placeholder="Selecione o Cliente">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>
                    <x-adminlte-options :selected="$sale->client_id" :options="$clients->pluck('name', 'id')->toArray()" />
                </x-adminlte-select>
            </div>

            <!-- Container para os produtos -->
            <div id="products-container">
                <div class="row product-row">
                    <x-adminlte-select name="product_id[]" label="Produtos" fgroup-class="col-md-6">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fas fa-box"></i>
                            </div>
                        </x-slot>
                        <x-adminlte-options selected="Selecione o produto" :options="$products->pluck('name', 'id')->toArray()" />
                    </x-adminlte-select>

                    <x-adminlte-input label="Quantidade" type="number" name="quantity[]" value="1"
                        placeholder="Quantidade">
                        <x-slot name="appendSlot">
                            <x-adminlte-button type="button" class="btn-flat btn-danger remove-item-btn mx-2"
                                theme="danger" label="Remover" icon="fas fa-trash" />
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>

            <div class="py-2">
                <x-adminlte-button type="button" class="btn-flat add-item-btn" label="Adicionar produto" theme="primary"
                    icon="fas fa-plus" />
            </div>

            <x-adminlte-button class="btn-flat" type="submit" label="Comprar" theme="success"
                icon="fas fa-lg fa-cash-register" />
        </form>
    </div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container  = document.getElementById('products-container');
            const addItemBtn = document.querySelector('.add-item-btn');

            addItemBtn.addEventListener('click', () => {
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'product-row', 'mt-2');

                newRow.innerHTML = `
                    <x-adminlte-select name="product_id[]" label="Produtos" fgroup-class="col-md-6">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fas fa-box"></i>
                            </div>
                        </x-slot>
                        <x-adminlte-options selected="Selecione o produto" :options="$products->pluck('name', 'id')->toArray()" />
                    </x-adminlte-select>

                    <x-adminlte-input label="Quantidade" type="number" name="quantity[]" value="1" placeholder="Quantidade" >
                            <x-slot name="appendSlot">
                                <x-adminlte-button type="button" class="btn-flat btn-danger remove-item-btn mx-2" theme="danger" label="Remover" icon="fas fa-trash"/>
                            </x-slot>
                        </x-adminlte-input>`;

                container.appendChild(newRow);

                const removeItemBtn = newRow.querySelector('.remove-item-btn');
                removeItemBtn.addEventListener('click', () => {
                      newRow.remove();
                });
            });

            container.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-item-btn')) {
                    e.target.closest('.product-row').remove();
                }
            });
        });
    </script>
@stop
