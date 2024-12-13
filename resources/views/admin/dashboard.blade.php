@extends('adminlte::page')

@section('content')

    <x-adminlte-profile-widget name="Vendas" desc="Vendedores" theme="lightblue" img="https://picsum.photos/id/1/100"
        layout-type="classic">
        <x-adminlte-profile-row-item icon="fas fa-fw fa-user-friends" title="Vendedor 1" text="1" url="#"
            badge="teal" />

        <x-adminlte-profile-row-item icon="fas fa-fw fa-user-friends" title="Vendedor 2" text="2" url="#"
            badge="lightblue" />

    </x-adminlte-profile-widget>

    {{ $seller }}


@stop
