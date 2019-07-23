@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuários</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
                <h5 class="card-title"><a class="btn btn-sm btn-outline-success" href="{{ route('usuario.novo') }}">+ Usúario</a></h5>

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($usuarios as $usuario)
                      <tr>
                        <td>{{ $usuario->id }}</td>
                        <td><a href="{{ route('usuario.perfil', $usuario->id) }}">{{ $usuario->name}}</a></td>
                        <td class="right"> 
                        <a href="{{ route('usuario.editar', $usuario->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                        <a href="{{ route('usuarios.papel', $usuario->id) }}" class="btn btn-outline-info btn-sm">Papel</a>
                            <a href="{{ route('usuario.excluir', $usuario->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
                        </td>
                      </tr>
                      @endforeach
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
