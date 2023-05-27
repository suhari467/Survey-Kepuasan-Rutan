@extends('admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Instansi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Setting</li>
              <li class="breadcrumb-item"><a href="{{ url('setting/instansi') }}">Instansi</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form id="quickForm" action="{{ url('setting/instansi') }}/{{ $instansi->id }}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile Instansi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_instansi">Nama Instansi atau Perusahaan</label>
                    <input type="text" name="nama_instansi" id="nama_instansi" class="form-control @error('nama_instansi') is-invalid @enderror" placeholder="Nama Instansi atau Perusahaan" value="{{ old('nama_instansi', $instansi->nama_instansi) }}">
                    @error('nama_instansi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="alamat_instansi">Alamat Instansi atau Perusahaan</label>
                    <textarea class="form-control @error('alamat_instansi') is-invalid @enderror" name="alamat_instansi" id="alamat_instansi" cols="30" rows="3" placeholder="Alamat Lengkap Instansi atau Perusahaan">{{ old('alamat_instansi', $instansi->alamat_instansi) }}</textarea>
                    @error('alamat_instansi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="informasi_instansi">Informasi Instansi atau Perusahaan</label>
                    <textarea class="form-control @error('informasi_instansi') is-invalid @enderror" name="informasi_instansi" id="informasi_instansi" cols="30" rows="3" placeholder="Informasi Seputar Instansi atau Perusahaan">{{ old('informasi_instansi', $instansi->informasi_instansi) }}</textarea>
                    @error('informasi_instansi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telepon Instansi" value="{{ old('no_telp', $instansi->no_telp) }}">
                    @error('no_telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email Instansi</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email Instansi" value="{{ old('email', $instansi->email) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
        </div>
        <!-- /.row -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Logo Instansi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      @if ($instansi->logo)
                      <img class="img-preview img-fluid mb-3" width="100%" src="{{ asset('storage/instansi') }}/{{ $instansi->logo }}">
                      @else
                      <img class="img-preview img-fluid mb-3" width="100%" src="{{ asset('assets/img/logo.png') }}">
                      @endif
                    </div>
                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="logo">Logo Instansi atau Perusaan</label>
                        <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" value="{{ old('logo') }}" onchange="previewImage()">
                        <input type="hidden" id="oldFile" name="oldFile" value="{{ $instansi->logo }}">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="ukuran_logo">Ukuran Logo</label>
                        <input type="number" name="ukuran_logo" id="ukuran_logo" class="form-control @error('ukuran_logo') is-invalid @enderror" placeholder="Ukuran Logo di Laporan" value="{{ old('ukuran_logo', $instansi->ukuran_logo) }}">
                        @error('ukuran_logo')
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
                  <button type="submit" class="btn btn-success">Edit Instansi</button>
                </div>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
        </div>
        <!-- /.row -->
      </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
<script type="text/javascript">
  function previewImage() {
        const image = document.querySelector('#logo');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader =  new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection