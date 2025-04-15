@extends('adminlte::page')

@section('title', 'Cadastrar Vendedor')

@section('content_header')
    <h1><i class="fas fa-user-plus text-success"></i> Cadastrar Vendedor</h1>
@stop

@section('content')

    <div class="card shadow rounded">
        <div class="card-body">
            @if (auth()->user()->hasRole('admin'))
                <form action="{{ route('sellers.store') }}" method="post">
                    @csrf
                    @method('post')

                    <div class="row mb-3">
                        <x-adminlte-input name="name" label="Nome" placeholder="Nome do Vendedor" fgroup-class="col-md-6"
                            disable-feedback />
                        <x-adminlte-input name="email" label="E-mail" placeholder="Email do Vendedor"
                            fgroup-class="col-md-6" disable-feedback />
                    </div>

                    <div class="row mb-3">
                        <x-adminlte-input name="password" label="Senha" placeholder="Digite a senha" type="password"
                            fgroup-class="col-md-6" disable-feedback />
                        <x-adminlte-select name="role" label="Perfil do Usuário" fgroup-class="col-md-6"
                            disable-feedback>
                            <option value="">Selecione um perfil</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </x-adminlte-select>
                    </div>

                    <div class="row">
                        <div class="col text-end">
                            <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success"
                                icon="fas fa-lg fa-save" />
                        </div>
                    </div>
                </form>
            @else
                <div class="alert alert-danger">
                    Você não tem permissão para criar vendedores.
                </div>
            @endif
        </div>
    </div>
@stop
