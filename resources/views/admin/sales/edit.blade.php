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

            <div id="products-container">
                <label for="">Produtos</label>
                @foreach ($sale->products as $index => $product)
                    <div class="row product-row">
                        <x-adminlte-select name="product_id[]" fgroup-class="col-md-6"
                            data-placeholder="Selecione o Produto">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-box"></i>
                                </div>
                            </x-slot>
                            <x-adminlte-options :selected="$product->id" :options="$products->pluck('name', 'id')->toArray()" />
                        </x-adminlte-select>

                        <div class="col-md-2">

                            <x-adminlte-input type="number" name="quantity[]" value="{{ $product->pivot->quantity ?? 1 }}"
                                placeholder="Quantidade">
                            </x-adminlte-input>
                        </div>

                        <div class="col-md-2">

                            @if ($index == count($sale->products) - 1)
                                <x-adminlte-button id="iconAdd" class="btn-flat add-remove-btn" type="button" label="Adicionar"
                                    theme="warning" icon="fas fa-plus" />
                            @else
                                <x-adminlte-button class="btn-flat add-remove-btn" type="button" label="Remover"
                                    theme="danger" icon="fas fa-trash" />
                            @endif
                        </div>
                    </div>
                @endforeach

                @if ($sale->products->isEmpty())
                    <div class="row product-row">
                        <x-adminlte-select name="product_id[]" fgroup-class="col-md-6"
                            data-placeholder="Selecione o Produto">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-box"></i>
                                </div>
                            </x-slot>
                            <x-adminlte-options :options="$products->pluck('name', 'id')->toArray()" />
                        </x-adminlte-select>

                        <div class="col-md-2">

                            <x-adminlte-input type="number" name="quantity[]" value="1" placeholder="Quantidade">
                            </x-adminlte-input>
                        </div>

                        <div class="col-md-2">
                            <x-adminlte-button class="btn-flat add-remove-btn" type="button" label="Adicionar"
                                theme="warning" icon="fas fa-plus" />
                        </div>
                    </div>
                @endif
            </div>

            <x-adminlte-button class="btn-flat" type="submit" label="Comprar" theme="success"
                icon="fas fa-lg fa-cash-register" />
        </form>
    </div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function addProductRow() {
                let productRow = document.querySelector('.product-row').cloneNode(true);
                let select = productRow.querySelector('select');

                if (select) {
                    select.selectedIndex = 0;
                }

                let input = productRow.querySelector('input[type="number"]');

                if (input) {
                    input.value = '1';
                }

                let iconAdd = document.querySelector('#iconAdd');

                document.querySelectorAll('.product-row .add-remove-btn').forEach(function(btn) {
                    btn.textContent = 'Remover';
                    btn.classList.replace('btn-warning', 'btn-danger');
                    btn.classList.replace('fa-plus', 'fa-trash');
                    btn.removeEventListener('click', addProductRow);
                    btn.addEventListener('click', function() {
                        this.closest('.product-row').remove();
                    });
                });

                document.getElementById('products-container').appendChild(productRow);

                var lastRowButton = productRow.querySelector('.add-remove-btn');
                lastRowButton.textContent = 'Adicionar';
                lastRowButton.classList.replace('btn-danger', 'btn-warning');
                lastRowButton.classList.replace('fa-trash', 'fa-plus');
                lastRowButton.addEventListener('click', addProductRow);
            }

            document.querySelector('.product-row:last-child .add-remove-btn').addEventListener('click',
                addProductRow);
        });
    </script>
@stop
