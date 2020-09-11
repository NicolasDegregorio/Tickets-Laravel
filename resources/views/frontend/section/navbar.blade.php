 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <span>{{auth()->user()->name}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header" id="ticketsTotal"></span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" >
            <i class="fas fa-ticket-alt mr-2"></i> Tickets Sin Resolver
            <span class="float-right text-muted text-sm" id="ticketsUnresolved"> </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" >
            <i class="fas fa-ticket-alt mr-2"></i> Tickets en Progreso
            <span class="float-right text-muted text-sm" id="ticketsInProgress"> </span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/users/logout') }}" class="dropdown-item dropdown-footer">Cerrar Session</a>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->