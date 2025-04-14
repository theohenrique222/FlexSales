@extends('adminlte::page')

@section('title', 'Cadastrar Vendedor')

@section('content_header')
    <h1>Cadastrar Vendedor</h1>
@stop

@section('content')


    <form action="{{ route('sellers.store') }}" method="post">
        @csrf
        @method('post')
        <div class="row">
            <x-adminlte-input name="name" label="Nome" placeholder="Nome do Vendedor" fgroup-class="col-md-6"
                disable-feedback />
        </div>

        <div class="row">
            <x-adminlte-input name="email" label="E-mail" placeholder="Email do vendedor" fgroup-class="col-md-6"
                disable-feedback />
        </div>

        <div class="row">
            <x-adminlte-input name="password" label="Senha" placeholder="Digite a senha" type="password"
                fgroup-class="col-md-6">
            </x-adminlte-input>
        </div>

        <div class="row">
            <x-adminlte-select name="selBasic">
                <option value="">Selecione um perfil</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save" />
    </form>

@stop
