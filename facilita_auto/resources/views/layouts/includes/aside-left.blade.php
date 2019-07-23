
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
       <img src="{{ asset('img/logo.png') }}" alt="Mineiro Delivery" class="brand-image" style="opacity: .8"> 
      <span class="brand-text font-weight-light">Facilita Auto</span>  
    </a>
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(auth()->user()->image != "")
            <img src="{{ url('storage/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="img-circle elevation-2">  
          @endisset

          @empty(auth()->user()->image)
            <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="{{ auth()->user()->name }}">
          @endempty
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Início</p>
            </a>
        </li> 
          @can('usuario_listar')
            <li class="nav-item">
              <a href="{{ route('usuarios') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Usuários</p>
              </a>
            </li>
          @endcan
          @can('papel_listar')
            <li class="nav-item">
              <a href="{{ route('papel') }}" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Papéis</p>
              </a>
            </li>
          @endcan
          
          <li class="nav-item">
            <a href="{{ route('pedidos') }}" class="nav-link">
              <i class="nav-icon fas fa-car"></i>
              <p>Pedidos</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('configuracao') }}" class="nav-link">
              <i class="nav-icon fas fa-puzzle-piece"></i>
              <p>Configurações</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Sair</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>