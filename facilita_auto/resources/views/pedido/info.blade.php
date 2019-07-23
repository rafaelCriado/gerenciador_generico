@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pedido <b>#{{$pedido->id}}</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pedidos')}}">Pedidos</a></li>
              <li class="breadcrumb-item active">{{ $pedido->nome_fantasia }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            @include('pedido.info.dados')
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
              @include('pedido.info.debitos')
            </div>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  
@endsection
