@extends('admin.simple')

@section('content')
<div class="container">
  <div class="card card-outline card-primary">
    <div class="card-body">
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

      <form action="{{ route('survey.layanan') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <select name="layanan_id" id="layanan_id" class="form-control @error('layanan_id') is-invalid @enderror">
            @foreach ($services as $service)
            <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
          </select>
          @error('layanan_id')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <select name="pertanyaan_id" id="pertanyaan_id" class="form-control @error('pertanyaan_id') is-invalid @enderror">
            @foreach ($questions as $question)
            <option value="{{ $question->id }}">{{ $question->pertanyaan }}</option>
            @endforeach
          </select>
          @error('pertanyaan_id')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
        <div class="row">
          <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Buat Survey</button>
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