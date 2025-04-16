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

                <div class="col-md-6">
                    <x-adminlte-input name="user_name" label="Usuário Responsável" value="{{ auth()->user()->name }}"
                        fgroup-class="col-md-6" disabled />
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                </div>

            </div>

            <div id="products-container">
                <div class="row product-row">

                    <x-adminlte-select name="product_id[]" label="Produtos" fgroup-class="col-md-6">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fas fa-box"></i>
                            </div>
                        </x-slot>

                        <option selected disabled>Selecione o produto</option>

                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} |
                                Marca: {{ $product->brand }} |
                                Unidades: {{ $product->quantity }} |
                                Valor: {{ number_format($product->price, 2, ',', '.') . ' R$' }}

                            </option>
                        @endforeach
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
            const container = document.getElementById('products-container');
            const addItemBtn = document.querySelector('.add-item-btn');

            // Atualiza os options para evitar duplicados
            function updateSelectOptions() {
                const allSelects = container.querySelectorAll('select[name="product_id[]"]');

                // Pega todos os valores já selecionados
                const selectedValues = Array.from(allSelects).map(select => select.value);

                // Atualiza cada select individualmente
                allSelects.forEach(select => {
                    const currentValue = select.value;

                    Array.from(select.options).forEach(option => {
                        if (option.value === "" || option.disabled) return;

                        if (selectedValues.includes(option.value) && option.value !==
                            currentValue) {
                            option.disabled = true;
                        } else {
                            option.disabled = false;
                        }
                    });
                });
            }

            // Adiciona novo bloco
            addItemBtn.addEventListener('click', () => {
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'product-row', 'mt-2');

                const products = @json($products);

                let optionsHTML = '<option selected disabled>Selecione o produto</option>';
                products.forEach(product => {
                    optionsHTML += `<option value="${product.id}">
                        ${product.name} | Marca: ${product.brand} | Unidades: ${product.quantity} | Valor: ${parseFloat(product.price).toFixed(2).replace('.', ',')} R$
                    </option>`;
                });

                newRow.innerHTML = `
                    <div class="col-md-6">
                        <label>Produtos</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                            <select name="product_id[]" class="form-control">
                                ${optionsHTML}
                            </select>
                        </div>
                    </div>

                    <div class="">
                        <label>Quantidade</label>
                        <div class="input-group">
                            <input type="number" name="quantity[]" value="1" class="form-control" placeholder="Quantidade" />
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger btn-flat remove-item-btn mx-2">
                                    <i class="fas fa-trash"></i> Remover
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(newRow);
                updateSelectOptions();
            });

            // Remove item e atualiza selects
            container.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-item-btn') || e.target.closest(
                    '.remove-item-btn')) {
                    e.target.closest('.product-row').remove();
                    updateSelectOptions();
                }
            });

            // Detecta mudança em qualquer select pra atualizar os demais
            container.addEventListener('change', (e) => {
                if (e.target.name === "product_id[]") {
                    updateSelectOptions();
                }
            });

            // Atualiza ao carregar
            updateSelectOptions();
        });
    </script>

@stop
