@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perfil do Usuário</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('usuarios')}}">Usuarios</a></li>
              <li class="breadcrumb-item active">{{ $usuario->name }}</li>
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
                    @if(isset($usuario->image) && $usuario->image != "")
                        <img src="{{ url('storage/users/'.$usuario->image) }}" alt="{{ $usuario->name }}" class="profile-user-img img-responsive img-circle" style="max-width:150px">  
                    @endif
                    @empty($usuario->image)
                        <img src="{{ asset('img/user.png') }}" class="profile-user-img img-responsive img-circle" style="width:150px">
                    @endempty
                </div>

              <h3 class="profile-username text-center">{{$usuario->name}}</h3>

              <p class="text-muted text-center"><a href="mailto:{{$usuario->email}}">{{$usuario->email}}</a></p>
              @can('usuario_gerenciar')
                <br><br><br>
                <p>
                <a href="{{ route('usuario.editar', $usuario->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                <a href="{{ route('usuarios.papel', $usuario->id) }}" class="btn btn-outline-info btn-sm">Papel</a>
                <a href="{{ route('usuario.excluir', $usuario->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
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
