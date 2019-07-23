@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de Permissões para {{ $papel->nome }} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('papel')}}">Papéis</a></li>
              <li class="breadcrumb-item active">Permissões</li>
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
              <div class="row pb-3">
                  <div class="col">
                    <form method="POST" class="form" action="{{ route('papel.permissao.salvar',$papel->id) }}">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="permissao_id">Permissões</label>
                        <select class="form-control" required="required" id="permissao_id" name="permissao_id">
                            <option value="">- Selecione uma Permissão</option>
                          @foreach($permissaos as $permissao)
                            <option value="{{ $permissao->id }}">{{ $permissao->nome }}</option>
                          @endforeach
                        </select>
                      </div>
                      <button class="btn btn-sm btn-outline-success">+ Adicionar</button>
                    </form>
                    
                  </div>
                </div>

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        
                      <th>Permissão</th>
                      <th>Descrição</th>
                        <th></th>
                      </tr> 
                    </thead>
                    <tbody>
                      @foreach($papel->permissoes as $permissao)
                      <tr>
                        <td>{{ $permissao->nome }}</td>
                        <td>{{ $permissao->descricao}}</td>
                        <td class="right"> 
                            <a href="{{ route('papel.permissao.remover', [$papel->id, $permissao->id]) }}" class="btn btn-outline-danger btn-sm">Remover</a> 
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
