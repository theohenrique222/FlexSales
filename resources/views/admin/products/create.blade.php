@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
    <h1>Cadastro de Produtos</h1>
@stop

@section('content')
    @role('admin|gestor')
        <form action="{{ route('products.store') }}" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="name" label="Nome" placeholder="Nome do produto" fgroup-class="col-md-6"
                    disable-feedback />
            </div>

            <div class="row">
                <x-adminlte-input name="price" label="Preço" placeholder="Preço do produto" type="number"
                    fgroup-class="col-md-6">
                </x-adminlte-input>
            </div>


            <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save" />
        </form>
    @else
        <x-adminlte-alert theme="danger" title="Erro">
            Você não tem permissão!
        </x-adminlte-alert>
    @endrole
@stop
