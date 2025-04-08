@extends('adminlte::page')

@section('content_header')
    <h1>Painel de Controle</h1>
@stop

@section('content')

    <x-adminlte-profile-widget name="{{ auth()->user()->name ?? 'Sem identificação' }}" desc="Gestor de vendas" class="elevation-4 bg-primary text-bold"
        img="https://picsum.photos/id/1/100"  layout-type="classic"
        header-class="text-right" footer-class="bg-white">
        <x-adminlte-profile-col-item class="border-right text-dark" icon="fas fa-lg fa-tasks" title="Total de Clientes" url="/clients" text="{{ $allClients }}" size=6 badge="lime" />
        <x-adminlte-profile-col-item class="text-dark" icon="fas fa-lg fa-tasks" title="Total de Vendas" url="/sales" text="{{ $mySalesCount }}" size=6 badge="primary" />
        <x-adminlte-profile-row-item title="Redes Sociais" class="text-center text-dark border-bottom" />
        <x-adminlte-profile-row-item icon="fab fa-fw fa-2x fa-instagram text-dark" title="Instagram" url="#" size=4 />
        <x-adminlte-profile-row-item icon="fab fa-fw fa-2x fa-facebook text-dark" title="Facebook" url="#" size=4 />
        <x-adminlte-profile-row-item icon="fab fa-fw fa-2x fa-whatsapp text-dark" title="Whatsapp" url="#" size=4 />
    </x-adminlte-profile-widget>

@stop
