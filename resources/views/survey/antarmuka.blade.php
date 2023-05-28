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
  </div>
  @foreach($feedback as $use)
    <div class="col-lg-4 col-12">
      <!-- small card -->
      @if ($use['id'] == '1')
        <div class="small-box bg-danger" id="{{ $use['id'] }}" id="survey-{{ $use['id'] }}" data-id-survey="{{ $use['id'] }}" data-toggle="modal" data-target="#modal-kritik-{{ $use['id'] }}">
      @elseif($use['id'] == '2')
        <div class="small-box bg-warning" id="{{ $use['id'] }}" id="survey-{{ $use['id'] }}" data-id-survey="{{ $use['id'] }}" data-toggle="modal" data-target="#modal-kritik-{{ $use['id'] }}">
      @elseif($use['id'] == '3')
        <div class="small-box bg-success" id="{{ $use['id'] }}" id="survey-{{ $use['id'] }}" data-id-survey="{{ $use['id'] }}" data-toggle="modal" data-target="#modal-kritik-{{ $use['id'] }}">
      @endif
            <div class="inner">
              <h3 class="p-4"> 
                @if ($use['id'] == '1')
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM174.6 384.1c-4.5 12.5-18.2 18.9-30.7 14.4s-18.9-18.2-14.4-30.7C146.9 319.4 198.9 288 256 288s109.1 31.4 126.6 79.9c4.5 12.5-2 26.2-14.4 30.7s-26.2-2-30.7-14.4C328.2 358.5 297.2 336 256 336s-72.2 22.5-81.4 48.1zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                @elseif($use['id'] == '2')
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM176.4 240a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm192-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM184 328c-13.3 0-24 10.7-24 24s10.7 24 24 24H328c13.3 0 24-10.7 24-24s-10.7-24-24-24H184z"/></svg>
                @elseif($use['id'] == '3')
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                @endif
              </h3>
            </div>
        </div>
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
          <span class="badge bg-danger">{{ $use['name'] }}</span>
          @elseif ($use['id'] == '2')
          <span class="badge bg-warning">{{ $use['name'] }}</span>
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
        data: {
          _token: '{{ csrf_token() }}',
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

          $('#modal-kritik-'+feedback).modal('hide');
          $('#kritik-'+feedback).val(null);
          $("#overlay").remove();
        }
      });
    }
  });
</script>
@endsection