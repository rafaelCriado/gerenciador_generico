
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>window.Laravel =  { csrfToken: '{{ csrf_token() }}' }</script>

  <title>{{ config('app.name')}}</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
  <div id="app">
    <div class="wrapper">

      @include('layouts.includes.nav-superior')

      @include('layouts.includes.aside-left')

      <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @include('layouts.includes._mensagem_session')

      @yield('content')
    </div>
      
      

      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      @include('layouts.includes.footer')
    </div>
    <!-- ./wrapper -->

    
  </div>
  <!-- REQUIRED SCRIPTS -->
  <script src="{{ asset('js/app.js')}}"></script>


</body>
</html>
