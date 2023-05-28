@extends('admin.simple')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ url('/') }}" class="h3"><b>Survey Kepuasan Pelanggan</b></a><br>
      <img src="{{ asset('storage/instansi').'/'.$instansi->logo }}" alt="{{ $instansi->logo }}" width="100" class="my-2">
      <h3>
        {{ $instansi->nama_instansi }}
      </h3>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login to start your session</p>

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

      <form action="{{ route('auth') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="row">
          <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>

    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
      <p class="mb-2">
        <a href="{{ route('password.request') }}" class="text-center">Forgot your password ? Reset Here</a>
      </p>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
@endsection