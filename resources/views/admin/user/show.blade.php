@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Informasi Pengguna</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('setting/user') }}">Pengguna</a></li>
                <li class="breadcrumb-item active">Info</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          @if (session()->has('success'))
            <div id="session" data-type="success" data-session=" {{ session('success') }}"></div>
          @endif
          @if (session()->has('error'))
            <div id="session" data-type="error" data-session=" {{ session('error') }}"></div>
          @endif

          <!-- Profile Image -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Pengguna</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body box-profile">
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nama Pengguna</b> <a class="float-right">{{ $user->name }}</a>
                </li>
                <li class="list-group-item">
                  <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Level</b> <a class="float-right">{{ $user->role->keterangan }}</a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="float-right">{{ $user->status=='aktif' ? 'Aktif' : 'Belum Aktif' }}</a>
                </li>
                <li class="list-group-item">
                  <b>Bergabung sejak</b> <a class="float-right">{{ 'Tanggal '.date('d-m-Y', strtotime($user->created_at)) }} ({{ $user->created_at->diffForHumans() }})</a>
                </li>
                <li class="list-group-item">
                  <b>Terakhir login</b> <a class="float-right">{{ $user->last_login_at ? 'Pukul '.date('H:i, d-m-Y', strtotime($user->last_login_at)) : '' }} ({{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Belum Login' }})</a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-md-6">
          <!-- About Me Box -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Profile Perusahaan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <p class="text-center">
                @if ($user->profile)
                      @if ($user->profile->logo_perusahaan)
                      <img class="profile-user-img img-fluid img-circle mb-2"
                          src="{{ asset('storage/profile').'/'.$user->profile->logo_perusahaan }}"
                          alt="User profile picture">  
                      @else
                      <img class="profile-user-img img-fluid img-circle mb-2"
                          src="{{ asset('assets/img/blank-profile.jpg') }}"
                          alt="User profile picture">  
                      @endif
                  @else
                  <img class="profile-user-img img-fluid img-circle mb-2"
                      src="{{ asset('assets/img/blank-profile.jpg') }}"
                      alt="User profile picture">  
                  @endif
                  <br>
                  <strong>Logo Perusahaan</strong>
              </p>

              <hr>

              <strong><i class="fa fa-building mr-1"></i> Nama Perusahaan</strong>

              <p class="text-muted">
                {{ $user->profile ? $user->profile->nama_perusahaan : '' }}
              </p>

              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat Perusahaan</strong>

              <p class="text-muted">
                {{ $user->profile ? $user->profile->alamat_perusahaan : '' }}
              </p>

              <hr>

              <strong><i class="fa fa-phone mr-1"></i> Nomor Telephone</strong>

              <p class="text-muted">
                {{ $user->profile ? $user->profile->no_telp_perusahaan : '' }}
              </p>

              <hr>

              <strong><i class="fa fa-file mr-1"></i> Jumlah Postingan</strong>

              <p class="text-muted">
                {{ $user->profile ? $user->posts->count().' Postingan' : '' }}
              </p>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@section('javascript')
<script type="text/javascript">
  const data = $('#session').data('session');
  const type = $('#session').data('type');
  const title = type=='success' ? 'Berhasil' : 'Gagal';

  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

  if(data){
    Swal.fire({
      title: title,
      text: data,
      icon: type,
      confirmButtonText: 'Selesai'
    })
  }
</script>
@endsection