  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->

    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="/dashboard" class="nav-link <?php if(Request::segment(1)=='dashboard') echo 'active';?>" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/organization" class="nav-link  <?php if(Request::segment(1)=='organization') echo 'active';?>">
              <i class="nav-icon fas fa-th"></i>
              <p>Organization </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/employees" class="nav-link <?php if(Request::segment(1)=='employees') echo 'active';?>" >
              <i class="nav-icon fas fa-th"></i>
              <p>Employees </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->