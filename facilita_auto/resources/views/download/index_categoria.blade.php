@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $categoria->nome }} <small>(downloads)</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('downloads')}}">Downloads</a></li>
              <li class="breadcrumb-item">{{ $categoria->nome }}</li>
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
                <h5 class="card-title"><a class="btn btn-sm btn-outline-success" href="{{ route('download.novo') }}">+ Download</a></h5>
                <hr>
                <div class="box-body table-responsive no-padding">
                  <h4>Videos</h4>
                  <table class="table table-borderless">  
                    <thead>
                      <tr>
                        
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Caminho</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($categoria)
                        @foreach($categoria->donwloads as $donwload)
                          @if($donwload->tipo =='video')
                            <tr>
                              <td>{{ $donwload->nome}}</td>
                              <td>{{ $donwload->descricao}}</td>
                              <td>{{ $donwload->caminho}}</td>
                              <td class="right"> 
                                  <a href="{{ route('download',$donwload->id )}}" class="btn btn-outline-primary btn-sm">Download</a>
                                  <a href="{{ route('download.editar', $donwload->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
                                  <a href="{{ route('download.excluir', $donwload->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      @endisset
                    </tbody>
                  </table>

                  <hr>
                  <h4>Imagens</h4>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Caminho</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($categoria)
                        @foreach($categoria->donwloads as $donwload)
                          @if($donwload->tipo =='imagem')
                            <tr>
                              <td>{{ $donwload->nome}}</td>
                              <td>{{ $donwload->descricao}}</td>
                              <td>{{ $donwload->caminho}}</td>
                              <td class="right"> 
                                  <a href="{{ route('download',$donwload->id )}}" class="btn btn-outline-primary btn-sm">Download</a>
                                  <a href="{{ route('download.editar', $donwload->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
                                  <a href="{{ route('download.excluir', $donwload->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      @endisset
                    </tbody>
                  </table>

                  <hr>
                  <h4>Áudios</h4>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Caminho</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($categoria)
                        @foreach($categoria->donwloads as $donwload)
                          @if($donwload->tipo =='audio')
                            <tr>
                              <td>{{ $donwload->nome}}</td>
                              <td>{{ $donwload->descricao}}</td>
                              <td>{{ $donwload->caminho}}</td>
                              <td class="right"> 
                                  <a href="{{ route('download',$donwload->id )}}" class="btn btn-outline-primary btn-sm">Download</a>
                                  <a href="{{ route('download.editar', $donwload->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
                                  <a href="{{ route('download.excluir', $donwload->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      @endisset
                    </tbody>
                  </table>

                  <hr>
                  <h4>Arquivos</h4>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Caminho</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($categoria)
                        @foreach($categoria->donwloads as $donwload)
                          @if($donwload->tipo =='arquivo')
                          <tr>
                            
                            <td>{{ $donwload->nome}}</td>
                            <td>{{ $donwload->descricao}}</td>
                            <td>{{ $donwload->caminho}}</td>
                            <td class="right"> 
                                <a href="{{ route('download',$donwload->id )}}" class="btn btn-outline-primary btn-sm">Download</a>
                                <a href="{{ route('download.editar', $donwload->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
                                <a href="{{ route('download.excluir', $donwload->id) }}" class="btn btn-outline-danger btn-sm">Excluir</a> 
                            </td>
                          </tr>
                          @endif
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
