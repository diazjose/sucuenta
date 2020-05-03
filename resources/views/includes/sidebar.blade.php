<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="{{ asset('img/sucuenta2.png') }}" width="30">
        </div>
        <div class="sidebar-brand-text mx-3">SuCuenta <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
          <i class="fa fa-bars"></i>
          <span>Menu</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Usuarios
      </div>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fa fa-list"></i>
          <span>Listado de Usuarios</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Clientes
      </div>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('client.new')}}">
          <i class="fa fa-address-card"></i>
          <span>Añadir Cliente</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('client.list')}}">
          <i class="fas fa-search"></i>
          <span>Buscar Clientes</span></a>
      </li>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Ventas y pagos
      </div>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-calendar fa-2x"></i>
          <span>Ventas</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-dollar-sign fa-2x "></i>
          <span>Pagos</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>