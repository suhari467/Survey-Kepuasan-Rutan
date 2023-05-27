@extends('admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Profile Perusahaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('profile') }}">Profile</a></li>
              <li class="breadcrumb-item active">Tambah Perusahaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Tambah Profile Perusahaan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan') }}">
                    @error('nama_perusahaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alamat_perusahaan">Alamat Perusahaan</label>
                    <input type="text" name="alamat_perusahaan" id="alamat_perusahaan" class="form-control @error('alamat_perusahaan') is-invalid @enderror" placeholder="Alamat Perusahaan" value="{{ old('alamat_perusahaan') }}">
                    @error('alamat_perusahaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="no_telp_perusahaan">No Telephone Perusahaan</label>
                    <input type="text" name="no_telp_perusahaan" id="no_telp_perusahaan" class="form-control @error('no_telp_perusahaan') is-invalid @enderror" placeholder="Alamat Perusahaan" value="{{ old('no_telp_perusahaan') }}">
                    @error('no_telp_perusahaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="logo_perusahaan">Logo Perusahaan</label>
                    <div class="row">
                      <div class="col-md-3">
                        <img src="{{ asset('assets/img/blank-profile.jpg') }}" alt="Blank Profile" class="img-thumbnail" id="imagePreview">
                      </div>
                      <div class="col-md-9">
                        <input type="file" name="logo_perusahaan" id="logo_perusahaan" class="form-control @error('logo_perusahaan') is-invalid @enderror" placeholder="Foto Perusahaan" onchange="previewImage()">
                        @error('logo_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Tambah Data</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
<script type="text/javascript">
    function previewImage() {
        const logo_perusahaan = document.querySelector('#logo_perusahaan');
        const imagePreview = document.querySelector('#imagePreview');

        const oFReader =  new FileReader();
        oFReader.readAsDataURL(logo_perusahaan.files[0]);

        oFReader.onload = function(oFREvent) {
            imagePreview.src = oFREvent.target.result;
        }
    }
</script>    
@endsection