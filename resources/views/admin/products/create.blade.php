@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
    <h1>Cadastro de Produtos</h1>
@stop

@section('content')
    @role('admin|gestor')
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <x-adminlte-card title="Cadastrar Produto" theme="primary" icon="fas fa-box-open" class="elevation-4" body-class="pb-0">

                <div class="row">
                    <x-adminlte-input name="name" label="Nome do Produto" placeholder="Ex: Notebook Dell" icon="fas fa-tag"
                        fgroup-class="col-md-6 mb-3" disable-feedback />

                    <x-adminlte-input name="price" label="Preço (R$)" placeholder="Ex: 1.999.99" icon="fas fa-dollar-sign"
                        type="number" step="0.01" fgroup-class="col-md-3 mb-3" />

                    <x-adminlte-input name="quantity" label="Quantidade em Estoque" placeholder="Ex: 10" icon="fas fa-cubes"
                        type="number" fgroup-class="col-md-3 mb-3" />
                </div>

                <div class="d-flex justify-content-end pt-2">
                    <x-adminlte-button class="btn-flat my-2" type="submit" label="Salvar Produto" theme="success"
                        icon="fas fa-lg fa-save" />
                </div>

            </x-adminlte-card>
        </form>
    @else
        <x-adminlte-alert theme="danger" title="Erro">
            Você não tem permissão!
        </x-adminlte-alert>
    @endrole
@stop
