@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Franquia</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('franquias')}}">Franquias</a></li>
              <li class="breadcrumb-item active">{{ $franquia->nome_fantasia }}</li>
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
          <div class="col-lg-4">
            <div class="card card-warning card-outline">
              <div class="card-body">
                
              <div class="box-body box-profile text-center">
                <div class="image text-center">
                        <img src="{{ asset('img/enterprise.png') }}" class="profile-user-img img-responsive img-circle" style="width:150px">
                </div>

              <h3 class="profile-username text-center">{{$franquia->nome_fantasia}}</h3>

              <p class="text-muted text-center"><a href="mailto:{{$franquia->email}}">{{$franquia->email}}</a></p>
              <p class="text-muted text-center">CNPJ. {{$franquia->cnpj}}</p>
              <span class="text-muted text-center">{{$franquia->razao_social}}</span><br>
              <span class="text-muted text-center">
                {{$franquia->endereco}}, {{$franquia->endereco_numero}} - {{$franquia->endereco_bairro}} 
                <br>CEP {{$franquia->endereco_cep}} 
                <br>{{$franquia->endereco_cidade}} - {{$franquia->endereco_estado}} 
                <br> Tel. {{$franquia->telefone}}
              </span>
              @can('franquia_gerenciar')
              <br><br><br>
              <p>
                <a href="{{ route('franquia.editar', $franquia->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                <a href="{{ route('franquia.excluir', $franquia->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
              </p>
              @endcan
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
