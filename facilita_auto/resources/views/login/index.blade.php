
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>{{ config('app.name')}} - Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/signin.css">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center" style="background: #909090; height: 100%; color: #fff;">
    
    <form class="form-signin" action="{{ route('login') }}" method="POST">
        
        {!! csrf_field() !!}
        <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="100" height="100">
        <h1 class="h3 mb-3 font-weight-normal">Acesso Facilita Auto</h1>
        
        @include('layouts.includes._mensagem_session')
        <br>
        @include('login._form')
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        <p class="mt-5 mb-3 text-muted" style="color:#fff !important;">&copy; todos os direitos reservados</p>
    </form>
      
    <script src="{{ asset('js/app.js')}}"></script>
  </body>
</html>