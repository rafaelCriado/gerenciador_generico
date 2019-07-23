@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pedidos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
              <li class="breadcrumb-item active">Pedido</li>
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
            <div class="card card-warning card-outline">
              <div class="card-body">
                <h5 class="card-title"><a class="btn btn-sm btn-outline-success" href="{{ route('pedido.novo') }}">+ Pedido</a></h5>

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Placa/Renavam</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($pedidos)  
                        @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td><a href="{{ route('pedido.info', $pedido->id) }}" >{{ $pedido->nome}}</a></td>
                            <td>{{ $pedido->cpf}}</td>
                            <td>{{ $pedido->placa}}</td>
                            <td class="right"> 
                                <a href="{{ route('pedido.editar', $pedido->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
                                <a href="{{ route('pedido.excluir', $pedido->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
                            </td>
                        </tr>
                        @endforeach
                      @endisset
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  
@endsection
