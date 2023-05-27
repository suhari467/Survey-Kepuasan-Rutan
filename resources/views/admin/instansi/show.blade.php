@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Info Pengaturan Instansi</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Setting</li>
                <li class="breadcrumb-item"><a href="{{ url('setting/instansi') }}">Instansi</a></li>
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
              <h3 class="card-title">Profile Instansi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body box-profile">
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nama Instansi</b> <a class="float-right">{{ $instansi->nama_instansi }}</a>
                </li>
                <li class="list-group-item">
                  <b>Alamat Instansi</b> <a class="float-right">{{ $instansi->alamat_instansi }}</a>
                </li>
                <li class="list-group-item">
                  <b>Informasi Instansi</b> <a class="float-right">{{ $instansi->informasi_instansi }} </a>
                </li>
              </ul>

              <a href="{{ url('setting/instansi').'/'.$instansi->id.'/edit' }}" class="btn btn-success btn-block"><b>Edit Detail</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <!-- About Me Box -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Informasi Pemegang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if($instansi->logo)
                <hr>
  
                <strong><i class="fa fa-image mr-1 mb-2"></i> Preview</strong>
                <p class="text-muted">
                  <img class="img-fluid mb-2"
                      src="{{ asset('storage/instansi').'/'.$instansi->logo }}"
                      alt="{{ $instansi->logo }}"
                      width="200">    
                </p>
              @endif
  
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