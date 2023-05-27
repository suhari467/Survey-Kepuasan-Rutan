<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      @if(session()->has('logo'))
      <img src="{{ asset('storage/instansi').'/'.session()->get('logo') }}" alt="Logo Instansi" class="brand-image img-circle elevation-3" style="opacity: .8">
      @else
      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Instansi" class="brand-image img-circle elevation-3" style="opacity: .8">
      @endif
      <span class="brand-text font-weight-light">Survey Pelanggan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(auth()->user()->profile)
            @if (auth()->user()->profile->logo_perusahaan)
            <img src="{{ asset('storage/profile').'/'.auth()->user()->profile->logo_perusahaan }}" class="img-circle elevation-2" alt="User Image">
            @else
            <img src="{{ asset('assets/img/blank-profile.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @endif
          @else
          <img src="{{ asset('assets/img/blank-profile.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="{{ url('profile') }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link {{ $slug=="dashboard" ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/profile') }}" class="nav-link {{ $slug=="profile" ? 'active' : ''}}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          @if(auth()->user()->role->name == 'user')
          <li class="nav-item">
            <a href="{{ url('/arsip') }}" class="nav-link {{ $slug=="arsip" ? 'active' : ''}}">
              <i class="nav-icon far fas fa-th"></i>
              <p>Data Arsip</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/uraian') }}" class="nav-link {{ $slug=="uraian" ? 'active' : ''}}">
              <i class="nav-icon far fas fa-list"></i>
              <p>Data Uraian Arsip</p>
            </a>
          </li>
          @endif
          @if(auth()->user()->role->name == 'admin')
          <li class="nav-item">
            <a href="{{ url('/laporan') }}" class="nav-link {{ $slug=="laporan" ? 'active' : ''}}">
              <i class="nav-icon fas fa-file-export"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/layanan') }}" class="nav-link {{ $slug=="layanan" ? 'active' : ''}}">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Layanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/question') }}" class="nav-link {{ $slug=="question" ? 'active' : ''}}">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Pertanyaan
              </p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('setting/*') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('setting/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Pengaturan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/setting/user') }}" class="nav-link {{ $slug=="user" ? 'active' : ''}}">
                  <i class="nav-icon fa fa-users"></i>
                  <p>Pengaturan Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/setting/instansi') }}" class="nav-link {{ $slug=="instansi" ? 'active' : ''}}">
                  <i class="nav-icon fa fa-building"></i>
                  <p>Pengaturan Instansi</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item">
            <hr class="border border-secondary">
            <form action="{{ route('logout') }}" method="post" id="logoutForm">
              @csrf
              <button class="btn btn-danger btn-block text-left" type="button" id="logout" name="logout" value="logout">&nbsp;<i class="nav-icon fas fa-power-off"></i> Logout </button>
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>