@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
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
                  <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Level</b> <a class="float-right">{{ $user->role->keterangan }}</a>
                </li>
                <li class="list-group-item">
                  <b>Bergabung sejak</b> <a class="float-right">{{ date('d-m-Y', strtotime($user->created_at)) }} ({{ $user->created_at->diffForHumans() }})</a>
                </li>
              </ul>

              <a href="{{ url('profile/edit') }}" class="btn btn-primary btn-block"><b>Edit Detail</b></a>
              <a href="{{ url('profile/password') }}" class="btn btn-warning btn-block"><b>Ubah Password</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
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