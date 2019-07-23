@extends('layouts.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contato</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Contato</li>
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
                
                <div class="box-body no-padding">
                  <address class="p-2">
                    <h4><strong>{{ $matriz['nome_fantasia'] }}</strong></h4>
                    {{ $matriz['razao_social'] }}<br>
                    {{ $matriz['endereco']}}, {{ $matriz['endereco_numero']}}, {{ $matriz['endereco_bairro']}}<br>
                    {{ $matriz['endereco_cidade']}}, {{ $matriz['endereco_estado']}}, CEP: {{ $matriz['endereco_cep']}}<br>
                    {{ $matriz['endereco_complemento']}}<br>
                    <abbr title="Telefone">Tel:</abbr> {{ $matriz['telefone']}}<br>
                    <!-- <abbr title="Telefone">Tel2:</abbr> {{ $matriz['celular']}}<br> -->
                    <abbr title="Email">Email:</abbr> <a href="mailto:{{$matriz['email']}}"> {{$matriz['email']}}</a><br>
                  </address>
                </div>
              </div>
            </div>
          </div>
          
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->s
@endsection
