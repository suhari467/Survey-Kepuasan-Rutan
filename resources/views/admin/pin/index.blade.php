@extends('admin.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengaturan Pin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Setting</li>
                <li class="breadcrumb-item active">Pin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-6">
          @if (session()->has('success'))
            <div id="session" data-type="success" data-session=" {{ session('success') }}"></div>
          @endif
          @if (session()->has('error'))
            <div id="session" data-type="error" data-session=" {{ session('error') }}"></div>
          @endif
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body text-center">
              <h2>PIN Antarmuka</h2>
              <h1 class="display-4"><b>{{ $pin->pin }}</b></h1>
              <hr>
              <p>
                <form action="{{ url('setting/pin/update') }}" id="gantiForm" method="post">
                @csrf
                <h5>Masukkan PIN baru untuk mengubah PIN yang sudah ada</h5>
                <div class="form-group mt-3">
                  <input type="numeric" class="form-control" name="pin" id="pin" placeholder="Masukkan PIN, minimal 6 angka" required>
                </div>
                <button type="button" class="btn btn-warning btn-block ganti-item" type="button" name="ganti-submit">Ganti PIN</button>
                </form>
              </p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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

  $(function () {
    $('#table-uraian').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $(".ganti-item").on("click", function() {
      Swal.fire({
        title: 'Perhatian!',
        text: 'Apakah ingin mengubah PIN ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut'
      }).then((result) => { 
          if (result.value===true) { 
            $('#gantiForm').submit() // this submits the form 
          } 
      }) 
  })
</script>
@endsection