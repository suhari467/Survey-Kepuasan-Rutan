@extends('admin.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengaturan Instansi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Setting</li>
                <li class="breadcrumb-item active">Instansi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              @if (session()->has('success'))
                <div id="session" data-type="success" data-session=" {{ session('success') }}"></div>
              @endif
              @if (session()->has('error'))
                <div id="session" data-type="error" data-session=" {{ session('error') }}"></div>
              @endif
              <a href="{{ url('setting/instansi/create') }}" class="btn btn-primary mt-2 mb-2"><span class="fas fa-plus"></span> Tambah Instansi</a>            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="table-uraian" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Logo</th>
                    <th>Nama Instansi</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if ($data_instansi)    
                  @foreach($data_instansi as $instansi)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      @if ($instansi->logo)
                        <img src="{{ url('instansi') }}/{{ $instansi->logo }}" alt="{{ $instansi->nama_instansi }}" width="100">
                      @else
                        <img src="{{ url('assets/img/blank-profile.jpg') }}" alt="blank-profile" width="100">
                      @endif
                    </td>
                    <td>{{ ucwords(strtolower($instansi->nama_instansi)) }}</td>
                    <td>{{ $instansi->alamat_instansi }}</td>
                    <td>
                      @foreach ($status as $item)
                        @if ($item['id'] == $instansi->status)
                          <span class="badge bg-{{ $instansi->status==0 ? 'danger' : 'success' }}">{{ $item['name'] }}</span>
                        @break
                        @endif
                      @endforeach
                    <td>
                      <a href="{{ url('setting/instansi') }}/{{ $instansi->id }}" class="btn btn-sm btn-secondary"><span class="fas fa-info"></span> Info </a>
                      <a href="{{ url('setting/instansi') }}/{{ $instansi->id }}/edit" class="btn btn-sm btn-success"><span class="fas fa-edit"></span> Edit </a>
                      @foreach ($status as $item)
                        @if ($item['id'] == $instansi->status)
                          @if ($item['name'] == 'tidak aktif')
                          <form action="{{ url('setting/instansi') }}/{{ $instansi->id }}/status" id="statusForm-{{ $instansi->id }}" method="post" class="d-inline">
                            @csrf
                            <button class="btn btn-warning btn-sm border-0 status-item" type="button" name="statusId" value="{{ $instansi->id }}"><span class="fas fa-check"></span> Status</button>
                          </form>
                          <form action="{{ url('setting/instansi') }}/{{ $instansi->id }}" id="hapusForm-{{ $instansi->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger btn-sm border-0 hapus-item" type="button" name="hapusId" value="{{ $instansi->id }}"><span class="fas fa-trash"></span> Hapus</button>
                          </form>
                          @endif
                        @break
                        @endif
                      @endforeach
                  </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="6">Data Kosong</td>
                  </tr>
                  @endif
                  </tbody>
                </table>
              </div>
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

  $(".hapus-item").on("click", function() {
    var id = $(this).val();

      Swal.fire({
        title: 'Perhatian!',
        text: 'Apakah ingin menghapus setting tersebut ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut'
      }).then((result) => { 
          if (result.value===true) { 
            $('#hapusForm-'+id).submit() // this submits the form 
          } 
      }) 
  })

  $(".status-item").on("click", function() {
    var id = $(this).val();

      Swal.fire({
        title: 'Perhatian!',
        text: 'Apakah ingin mengubah status menjadi aktif ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut'
      }).then((result) => { 
          if (result.value===true) { 
            $('#statusForm-'+id).submit() // this submits the form 
          } 
      }) 
  })
</script>
@endsection