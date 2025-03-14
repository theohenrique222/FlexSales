@extends('adminlte::page')

@section('content')

    <x-adminlte-profile-widget name="Bem vindo" desc="{{ $user[0]['name'] ?? 'Sem identificação' }}" theme="lightblue"
        img="https://picsum.photos/id/1/100" layout-type="classic">

        <p>TODOS OS CLIENTES</p>

        @foreach ($client as $clients)
            <x-adminlte-profile-row-item icon="fas fa-fw fa-user-friends" title="{{ $clients['name'] }}"
                text="{{ $clients['id'] }}" url="#" badge="teal" />
        @endforeach

    </x-adminlte-profile-widget>

    <x-adminlte-modal id="modalCustom" title="Account Policy" size="lg" theme="teal" icon="fas fa-bell" v-centered
        static-backdrop scrollable>
        <div style="height:800px;">Read the account policies...</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Accept" />
            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
    
    <x-adminlte-button label="Open Modal" data-toggle="modal" data-target="#modalCustom" class="bg-teal" />

@stop
