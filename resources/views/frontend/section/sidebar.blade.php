  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('AdminLTE/dist/img/logo.jpeg') }}" alt="sigef" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIGEF</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"> Usuario : {{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ url('/dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>
                  Tickets
                  {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/calendar') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendario Tareas
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/report') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                  Reportes
                  {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/stock') }}" class="nav-link">
                <i class="nav-icon fas fa-dolly-flatbed"></i>
                <p>
                  Stock
                </p>
              </a>
            </li>
          @if (auth()->user()->role->name == 'admin')  
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Administracion
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('/dashboard/usuarios') }}" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/institution') }}" class="nav-link">
                    <i class="fas fa-school nav-icon"></i>
                    <p>Instituciones</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/category') }}" class="nav-link">
                    <i class="fas fa-border-all nav-icon"></i>
                    <p>Categorias Stock</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/office') }}" class="nav-link">
                    <i class="fas fa-building nav-icon"></i>
                    <p>Oficinas Stock</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>