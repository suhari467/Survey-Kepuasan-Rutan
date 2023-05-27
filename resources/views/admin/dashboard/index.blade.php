@extends('admin.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Home</li>
            </ol>

            @if (session()->has('success'))
              <div id="session" data-type="success" data-session=" {{ session('success') }}"></div>
            @endif
            @if (session()->has('error'))
              <div id="session" data-type="error" data-session=" {{ session('error') }}"></div>
            @endif

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
              <h4>Ringkasan Informasi</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="fa fa-th"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Total Arsip</span>
                    <span class="info-box-number">
                      <h4>
                        <b></b>
                      </h4>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-danger"><i class="fa fa-file"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Total Arsip Belum Tervalidasi</span>
                    <span class="info-box-number">
                      <h4>
                        <b></b>
                      </h4>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-success"><i class="fa fa-list"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Total Uraian</span>
                    <span class="info-box-number">
                      <h4>
                        <b></b>
                      </h4>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
          <!-- /.row -->
          </div>
        </div>
      </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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