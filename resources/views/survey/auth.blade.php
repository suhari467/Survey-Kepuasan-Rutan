@extends('admin.simple')

@section('content')
<div class="container">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ url('/') }}" class="h3"><b>Survey Kepuasan Pelanggan</b> </a><br>
      <img src="{{ asset('storage/instansi').'/'.$instansi->logo }}" alt="{{ $instansi->logo }}" width="100" class="my-2">
      <h3>
        {{ $instansi->nama_instansi }}
      </h3>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Enter PIN to access interface</p>

      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
        </div>
      @endif

      @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('survey.auth') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="password" name="pin" id="pin" class="form-control @error('pin') is-invalid @enderror" placeholder="PIN Authentication">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          @error('pin')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="row">
          <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
      <p class="mb-2">
        <a href="{{ url('/dashboard') }}" class="text-center">Kembali ke menu sebelumnya</a>
      </p>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
@endsection