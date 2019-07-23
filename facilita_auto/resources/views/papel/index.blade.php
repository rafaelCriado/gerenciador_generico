@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Papéis</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Papéis</li>
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
                <h5 class="card-title"><a class="btn btn-sm btn-outline-success" href="{{ route('papel.novo') }}">+ Papel</a></h5>

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($papels)
                        @foreach($papels as $papel)
                        <tr>
                          <td>{{ $papel->id }}</td>
                          <td>{{ $papel->nome}}</td>
                          <td>{{ $papel->descricao}}</td>
                          <td class="right"> 
                            <a href="{{ route('papel.permissao', $papel->id) }}" class="btn btn-outline-primary btn-sm">Permissões</a>
                              @if( $papel->nome != 'admin')
                              <a href="{{ route('papel.editar', $papel->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
                                <a href="{{ route('papel.excluir', $papel->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
                              @else
                                <a class="btn btn-outline-info btn-sm disabled">Editar</a>
                                <a class="btn btn-outline-danger btn-sm disabled">Excluir</a>   
                              @endif
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
