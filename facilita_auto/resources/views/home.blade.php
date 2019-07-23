@extends('layouts.master')

@section('content')
<div class="container-fluid">
  <div class="row p-2">
      @can('usuario_listar')
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner c-white">
              <h3>{{ $qtde['usuarios']}}</h3>

              <p>Usúarios Cadastrados</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-user"></i>
            </div>
            <a href="{{ route('usuarios') }}" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      @endcan
    </div>
</div>
@endsection
