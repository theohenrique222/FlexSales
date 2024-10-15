@extends('adminlte::page')

@section('title', 'Editar Vendedor')

@section('content_header')
    <h1>Editar Vendedor</h1>
@stop

@section('content')

    <form action="{{ route('sellers.update', $seller->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <x-adminlte-input name="name" label="Nome" placeholder="Nome do Vendedor" fgroup-class="col-md-6"
                disable-feedback value="{{ $seller->user->name }}"/>
        </div>

        <div class="row">
            <x-adminlte-input name="email" label="E-mail" placeholder="Email do vendedor" fgroup-class="col-md-6"
                disable-feedback value="{{ $seller->user->email }}"/>
        </div>

        <div class="row">
            <x-adminlte-input name="password" label="Senha" placeholder="Digite a senha" type="password" fgroup-class="col-md-6">
            </x-adminlte-input>
        </div>

        <x-adminlte-button class="btn-flat" type="submit" label="Editar" theme="success" icon="fas fa-lg fa-save" />
    </form>

@stop
