@extends('waiting')

@section('content')
<div class="container">
<!-- Small Box (Stat card) -->
<div class="row justify-content-center mt-2">
  <div class="col-lg-12 mb-4">
    @if (session()->has('success'))
      <div id="session" data-type="success" data-session=" {{ session('success') }}"></div>
    @endif
    @if (session()->has('error'))
      <div id="session" data-type="error" data-session=" {{ session('error') }}"></div>
    @endif
  <h3 class="mt-4 text-center">
    <a class="text-decoration-none" id="signout">
      Layanan: {{ $service->name }}
    </a>
    <form action="{{ url('antarmuka/keluar') }}" method="post" id='signoutForm'>
    @csrf
    </form>
  </h3>
  <h1 class="mt-4 text-center"><b>{{ $question->pertanyaan }}</b></h1>
  <hr>
  <h3 class="mt-4 text-center"><b> Silahkan pilih salah satu dibawah ini </b></h3>
  </div>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @foreach($feedback as $use)
    <div class="col-lg-4 col-12 text-center">
      <!-- small card -->
      @if ($use['id'] == '1')
        <div class="small-box bg-warning" id="{{ $use['id'] }}" id="survey-{{ $use['id'] }}" data-id-survey="{{ $use['id'] }}" data-toggle="modal" data-target="#modal-kritik-{{ $use['id'] }}">
      @elseif($use['id'] == '2')
        <div class="small-box bg-primary" id="{{ $use['id'] }}" id="survey-{{ $use['id'] }}" data-id-survey="{{ $use['id'] }}" data-toggle="modal" data-target="#modal-kritik-{{ $use['id'] }}">
      @elseif($use['id'] == '3')
        <div class="small-box bg-success" id="{{ $use['id'] }}" id="survey-{{ $use['id'] }}" data-id-survey="{{ $use['id'] }}" data-toggle="modal" data-target="#modal-kritik-{{ $use['id'] }}">
      @endif
            <div class="inner">
              <h3 class="p-4"> 
                @if ($use['id'] == '1')
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM176.4 240a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm192-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM184 328c-13.3 0-24 10.7-24 24s10.7 24 24 24H328c13.3 0 24-10.7 24-24s-10.7-24-24-24H184z"/></svg>
                @elseif($use['id'] == '2')
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                @elseif($use['id'] == '3')
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm130.7 57.9c-4.2-13.6 7.1-25.9 21.3-25.9H364.5c14.2 0 25.5 12.4 21.3 25.9C369 368.4 318.2 408 258.2 408s-110.8-39.6-127.5-94.1zm86.9-85.1l0 0 0 0-.2-.2c-.2-.2-.4-.5-.7-.9c-.6-.8-1.6-2-2.8-3.4c-2.5-2.8-6-6.6-10.2-10.3c-8.8-7.8-18.8-14-27.7-14s-18.9 6.2-27.7 14c-4.2 3.7-7.7 7.5-10.2 10.3c-1.2 1.4-2.2 2.6-2.8 3.4c-.3 .4-.6 .7-.7 .9l-.2 .2 0 0 0 0 0 0c-2.1 2.8-5.7 3.9-8.9 2.8s-5.5-4.1-5.5-7.6c0-17.9 6.7-35.6 16.6-48.8c9.8-13 23.9-23.2 39.4-23.2s29.6 10.2 39.4 23.2c9.9 13.2 16.6 30.9 16.6 48.8c0 3.4-2.2 6.5-5.5 7.6s-6.9 0-8.9-2.8l0 0 0 0zm160 0l0 0-.2-.2c-.2-.2-.4-.5-.7-.9c-.6-.8-1.6-2-2.8-3.4c-2.5-2.8-6-6.6-10.2-10.3c-8.8-7.8-18.8-14-27.7-14s-18.9 6.2-27.7 14c-4.2 3.7-7.7 7.5-10.2 10.3c-1.2 1.4-2.2 2.6-2.8 3.4c-.3 .4-.6 .7-.7 .9l-.2 .2 0 0 0 0 0 0c-2.1 2.8-5.7 3.9-8.9 2.8s-5.5-4.1-5.5-7.6c0-17.9 6.7-35.6 16.6-48.8c9.8-13 23.9-23.2 39.4-23.2s29.6 10.2 39.4 23.2c9.9 13.2 16.6 30.9 16.6 48.8c0 3.4-2.2 6.5-5.5 7.6s-6.9 0-8.9-2.8l0 0 0 0 0 0z"/></svg>
                @endif
              </h3>
            </div>
        </div>
        <h1> <b>{{ $use['name'] }} </b> </h1>
    </div>
  @endforeach
  </div>
</div>
<!-- /.container -->
@foreach($feedback as $use)
<div class="modal fade" id="modal-kritik-{{ $use['id'] }}">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          Feedback 
          @if ($use['id'] == '1')
          <span class="badge bg-warning">{{ $use['name'] }}</span>
          @elseif ($use['id'] == '2')
          <span class="badge bg-primary">{{ $use['name'] }}</span>
          @elseif ($use['id'] == '3')
          <span class="badge bg-success">{{ $use['name'] }}</span>
          @endif
        </h4>
        <button type="button" class="close" id="close-{{ $use['id'] }}" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('survey.store') }}" method="post" id="form-submit-{{ $use['id'] }}">
        @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="kritik-{{ $use['id'] }}">Kritik (tidak wajib)</label>
              <input type="hidden" name="service_id" value="{{ $service->id }}">
              <input type="hidden" name="question_id" value="{{ $question->id }}">
              <input type="hidden" name="feedback" id="feedback-{{ $use['id'] }}" value="{{ $use['id'] }}">
              <textarea class="form-control @error('kritik') is-invalid @enderror" name="kritik" id="kritik-{{ $use['id'] }}" cols="30" rows="3" placeholder="Kritik atau masukan anda tentang layanan ini">{{ old('kritik') }}</textarea>
              @error('kritik')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-block btn-primary" id="submit-kirim-{{ $use['id'] }}">Kirim</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
@endsection
@section('javascript')
<script type="text/javascript">
  const data = $('#session').data('session');
  const type = $('#session').data('type');
  const title = type=='success' ? 'Berhasil' : 'Gagal';

  SwAlt(data, type, title);

  function SwAlt(data, type, title){
    if(data){
      Swal.fire({
        title: title,
        text: data,
        icon: type,
        confirmButtonText: 'Selesai'
      })
    }
  }

  $("#signout").on("click", function() {
    Swal.fire({
      title: 'Perhatian!',
      text: 'Apakah anda ingin keluar antarmuka ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Lanjut'
    }).then((result) => { 
        if (result.value===true) { 
          $('#signoutForm').submit() // this submits the form 
        } 
    }) 
  })

  $(document).ready(function(){
    
    @foreach($feedback as $use)
      $('{{ "#".$use["id"] }}').click(function(){
          var id_survey = $('#survey-{{ $use["id"] }}').data('id-survey');
          
          $('#{{ $use["id"] }}').append('<div class="overlay" id="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>');
      });
    @endforeach
      
    @foreach($feedback as $use)
      $('#submit-kirim-{{ $use["id"] }}').on('click', function(){
          var kritik = $('#kritik-{{ $use["id"] }}').val();
          var feedback = $('#feedback-{{ $use["id"] }}').val();
          
          submitForm(kritik, feedback);
      });

      $('#modal-kritik-{{ $use["id"] }}').on('hidden.bs.modal', function () {
        $("#overlay").remove();
      })

      $('#close-{{ $use["id"] }}').on('click', function(){
        $("#overlay").remove();
      });
    @endforeach

    function submitForm(kritik, feedback){
      var kritik = kritik;
      var feedback = feedback;
      var question_id = {{ $question->id }};
      var service_id = {{ $service->id }};

      $.ajax({
        url: "{{ route('survey.store') }}",
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          question_id: question_id,
          service_id: service_id,
          kritik: kritik,
          feedback: feedback
        },
        dataType: 'json',
        success: function(data){
          var tipe = data.type;
          var pesan = data.message;
          var judul = tipe=='success' ? 'Berhasil' : 'Gagal';

          SwAlt(pesan, tipe, judul);

        }
      }).fail(function(){
          var tipe = 'error';
          var pesan = 'Survey gagal disimpan, silahkan reload halaman atau buat akses kembali';
          var judul = tipe=='success' ? 'Berhasil' : 'Gagal';
          SwAlt(pesan, tipe, judul);

      }).always(function() {
          $('#modal-kritik-'+feedback).modal('hide');
          $('#kritik-'+feedback).val(null);
          $("#overlay").remove();
      });
    }
  });
</script>
@endsection