@extends('adminlte::page')

@section('title', 'Editar Vendedor')

@section('content_header')
    <h1>Editar Vendedor</h1>
@stop

@section('content')
<div class="card shadow rounded">
    <div class="card-body">
        <form action="{{ route('sellers.update', $seller->id) }}" method="post">
            @csrf
            @method('put')

            <div class="row mb-3">
                <x-adminlte-input name="name" label="Nome" placeholder="Nome do Vendedor" fgroup-class="col-md-6"
                    disable-feedback value="{{ $seller->user->name }}" />
                <x-adminlte-input name="email" label="E-mail" placeholder="Email do Vendedor" fgroup-class="col-md-6"
                    disable-feedback value="{{ $seller->user->email }}" />
            </div>

            <div class="row mb-3">
                <x-adminlte-input name="password" label="Senha" placeholder="Digite a senha" type="password"
                    fgroup-class="col-md-6" />
                <x-adminlte-select name="role" label="Perfil do Usuário" fgroup-class="col-md-6" disable-feedback>
                    <option value="">Selecione um perfil</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $seller->user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </x-adminlte-select>
            </div>

            <div class="row">
                <div class="col text-end">
                    <x-adminlte-button class="btn-flat" type="submit" label="Editar" theme="success"
                        icon="fas fa-lg fa-save" />
                </div>
            </div>
        </form>
    </div>
</div>


@stop
