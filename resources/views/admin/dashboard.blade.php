@extends('adminlte::page')

@section('content_header')
    <h1>Painel de Controle</h1>
@stop

@section('content')

    <div class="card card-widget widget-user shadow">

        <div class="widget-user-header text-white" style="background: linear-gradient(45deg, #4b5259, #d2d8d9);">
            <h3 class="widget-user-username">{{ auth()->user()->name ?? 'Sem identificação' }}</h3>
            <h5 class="widget-user-desc"> 
                {{ ucfirst(auth()->user()->roles->first()->name ?? 'Sem cargo') }}
            </h5>
        </div>

        <div class="widget-user-image">
            <img class="img-circle elevation-3" src="https://picsum.photos/id/1/100" alt="User Avatar">
        </div>

        <div class="card-body pt-5">
            <div class="row text-center">
                <div class="col-sm-6 border-right">
                    <a href="/clients" class="text-dark">
                        <h5 class="font-weight-bold mb-0">{{ $allClients }}</h5>
                        <span>Total de Clientes</span>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="/sales" class="text-dark">
                        <h5 class="font-weight-bold mb-0">{{ $mySalesCount }}</h5>
                        <span>Total de Vendas</span>
                    </a>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center mb-2">
                <h6 class="text-muted text-uppercase">Redes Sociais</h6>
            </div>
            <div class="row text-center">
                <div class="col-4">
                    <a href="#" class="text-dark">
                        <i class="fab fa-instagram fa-2x mb-1"></i>
                        <div>Instagram</div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="#" class="text-dark">
                        <i class="fab fa-facebook fa-2x mb-1"></i>
                        <div>Facebook</div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="#" class="text-dark">
                        <i class="fab fa-whatsapp fa-2x mb-1"></i>
                        <div>Whatsapp</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop
