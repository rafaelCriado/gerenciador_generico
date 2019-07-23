@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Downloads</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Downloads</li>
              
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
                <h5 class="card-title">
                  @can('download_gerenciar')
                  <a class="btn btn-sm btn-outline-success" href="{{ route('download.novo') }}">+ Download</a>
                  @endcan
                  
                  @can('categorias_gerenciar')
                  <a class="btn btn-sm btn-outline-primary" href="{{ route('download.categorias') }}">Gerenciar Categorias</a>
                  @endcan
                </h5>

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Categorias</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @isset($categorias)
                        @foreach($categorias as $categoria)
                        <tr>
                          <td> 
                              <a href="{{ route('download.categoria', $categoria->id) }}" class="btn btn-outline-info btn-sm"> {{ $categoria->donwloads->count()}} Arquivos</a> 
                              &nbsp; {{ $categoria->nome}}
                              &nbsp;-&nbsp;{{ $categoria->descricao}}
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
