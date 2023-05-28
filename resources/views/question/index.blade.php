@extends('admin.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pertanyaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Pertanyaan</li>
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
              <a href="{{ route('pertanyaan.create') }}" class="btn btn-success mt-2 mb-2"><span class="fas fa-plus"></span> Tambah Pertanyaan</a>           
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="table-uraian" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Layanan</th>
                    <th>Pertanyaan</th>
                    <th>Banyak Survey</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if ($questions)    
                  @foreach($questions as $question)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $question->service->name }}</td>
                    <td>{{ $question->pertanyaan }}</td>
                    <td>{{ $question->surveys->count() }}</td>
                    <td>
                      <a href="{{ url('pertanyaan') }}/{{ $question->id }}" class="btn btn-sm btn-primary"><span class="fas fa-info"></span> Info </a>
                      <a href="{{ url('pertanyaan') }}/{{ $question->id }}/edit" class="btn btn-sm btn-success"><span class="fas fa-edit"></span> Edit </a>
                      <form action="{{ url('pertanyaan') }}/{{ $question->id }}" id="hapusForm-{{ $question->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm border-0 hapus-item" type="button" name="hapusId" value="{{ $question->id }}"><span class="fas fa-trash"></span> Hapus</button>
                      </form>
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
        text: 'Apakah ingin menghapus pertanyaan tersebut ?',
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
</script>
@endsection