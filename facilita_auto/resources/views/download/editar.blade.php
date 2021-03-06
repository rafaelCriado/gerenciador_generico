@extends('layouts.master')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Download</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('downloads')}}">Download</a></li>
            <li class="breadcrumb-item"><a href="{{ route('download.categoria', $download->categoria_id)}}">Categoria</a></li>
            <li class="breadcrumb-item active">Editar Download</li>
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
                <h5 class="card-title"></h5>

                <div class="box-body table-responsive no-padding">
                  <form action="{{ route('download.salvar', $download->id) }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="put">
                    @include('download._form')
                    <button class="btn btn-success float-right" type="submit">Salvar</button>
                  </form>
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
