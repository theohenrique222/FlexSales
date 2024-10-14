@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
    <h1>Editar Produtos</h1>
@stop

@section('content')
    <form action="{{ route('products.update', $product->id) }}" method="post">
        @csrf
        <div class="row">
            <x-adminlte-input name="name" label="Nome" placeholder="Nome do produto" fgroup-class="col-md-6"
                disable-feedback value="{{ $product->name }}"/>
        </div>

        <div class="row">
            <x-adminlte-input name="price" label="Preço" placeholder="Preço do produto" type="number" fgroup-class="col-md-6" value="{{ $product->price }}">
                <x-slot name="appendSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-hashtag"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>
        

        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop