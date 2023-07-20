
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte') }}/dist/img/logo-fastderm.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte') }}/dist/img/default.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user('username')->name; }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="{{ url('laporan') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Laporan">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('kas') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Kas & Bank">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Kas & Bank                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('penjualan.index') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Penjualan">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                 Penjualan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="{{ route('pembelian.index') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Pembelian">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                 Pembelian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="{{ url('pengeluaran') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Pengeluaran">
              <i class="nav-icon fas fa-minus-square"></i>
              <p>
                Pengeluaran               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('kontak') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Data Kontak">
              <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Kontak            
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('product.index') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Persediaan">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Persediaan
                
              </p>
            </a>      
       
          </li>

          <li class="nav-item">
            <a href="{{ url('account') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Data Akun">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Account         
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/pengaturan') }}" class="nav-link" data-toggle="tooltip" data-placement="right" title="Pengaturan">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pengaturan      
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
