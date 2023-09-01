@extends('admin.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
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
          @if (session()->has('success'))
            <div id="session" data-type="success" data-session=" {{ session('success') }}"></div>
          @endif
          @if (session()->has('error'))
            <div id="session" data-type="error" data-session=" {{ session('error') }}"></div>
          @endif
          <div class="card" id="card-filter">
            <!-- /.card-header -->
            <div class="card-body">
              <h4>Filter</h4>
              <hr>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="question_id">Pertanyaan</label>
                    <select name="question_id" id="question_id" class="form-control @error('question_id') is-invalid @enderror">
                      @foreach ($questions as $question)
                          <option value="{{ $question->id }}">{{ $question->pertanyaan }}</option>
                      @endforeach
                    </select>
                    @error('question_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="service_id">Layanan</label>
                    <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror">
                      @foreach ($services as $service)
                          <option value="{{ $service->id }}">{{ $service->name }}</option>
                      @endforeach
                    </select>
                    @error('service_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row align-items-end">
                <div class="col-6">
                  <div class="form-group mt-3">
                    <label for="range_tanggal">Rentang Tanggal</label>
                    <input type="text" class="form-control" name="range_tanggal" id="range_tanggal" required>
                    <input type="hidden" class="form-control" name="tanggal_awal" id="tanggal_awal" value="{{ date('Y-m-d') }}">
                    <input type="hidden" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="{{ date('Y-m-d') }}">
                  </div>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-success btn-block mb-3" type="button" name="cari-data-laporan" id="cari-data-laporan">Cari Data Laporan</button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" id="kop-surat">
            <div class="card-body">
              <div class="row d-flex justify-content-center">
                <img src="{{ url('storage/instansi') }}/{{ $instansi->logo }}" alt="{{ $instansi->nama_instansi }}" height="130">
                <div class="col ml-3">
                  <h2>Survey Kepuasan Pelanggan</h2>
                  <h1><b>{{ $instansi->nama_instansi }}</b></h1>
                  <h5>{{ $instansi->alamat_instansi }}</h5>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" id="card-laporan">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h4>LAPORAN PRESENTASI KEPUASAN</h4>
                </div>
                <div class="col-6 d-flex justify-content-end">
                  <button type="button" id="button-laporan" class="btn btn-primary" onclick="printLaporan()" ><i class="fas fa-print"></i> Print Laporan</button>
                </div>
              </div>
              <hr>
              <table style="width: 100%">
                <tr>
                  <td style="width: 19%">Tanggal</td>
                  <td style="width: 1%">:</td>
                  <td style="width: 80%" id="laporan_tanggal"></td>
                </tr>
                <tr>
                  <td style="width: 19%">Pertanyaan</td>
                  <td style="width: 1%">:</td>
                  <td style="width: 80%" id="laporan_pertanyaan"></td>
                </tr>
                <tr>
                  <td style="width: 19%">Layanan</td>
                  <td style="width: 1%">:</td>
                  <td style="width: 80%" id="laporan_layanan"></td>
                </tr>
                <tr>
                  <td style="width: 19%">Responden</td>
                  <td style="width: 1%">:</td>
                  <td style="width: 80%" id="laporan_responden"></td>
                </tr>
              </table>
              <div class="row my-3 gx-2">
                <div class="col-6">
                  <canvas id="doughnut-chart"></canvas>
                </div>
                <div class="col-6">
                  <canvas id="bar-chart"></canvas>
                </div>
              </div>
                <div class="row">
                  <div class="col-12 p-2">
                    <div class="table-responsive">
                      <table id="table-laporan" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Jumlah Survey</th>
                          </tr>
                        </thead>
                        <tbody id="laporan-tbody"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="row">
          <div class="col-12">
            <div class="card" id="card-kritik">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4>LAPORAN KRITIK</h4>
                  </div>
                  <div class="col-6 d-flex justify-content-end">
                    <button type="button" id="button-kritik" class="btn btn-primary" onclick="printKritik()" ><i class="fas fa-print"></i> Print Laporan Kritik</button>
                  </div>
                </div>
                <hr>
                <table style="width: 100%">
                  <tr>
                    <td style="width: 19%">Tanggal</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 80%" id="laporan_kritik_tanggal"></td>
                  </tr>
                  <tr>
                    <td style="width: 19%">Pertanyaan</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 80%" id="laporan_kritik_pertanyaan"></td>
                  </tr>
                  <tr>
                    <td style="width: 19%">Layanan</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 80%" id="laporan_kritik_layanan"></td>
                  </tr>
                  <tr>
                    <td style="width: 19%">Responden (kritik)</td>
                    <td style="width: 1%">:</td>
                    <td style="width: 80%" id="laporan_kritik_responden"></td>
                  </tr>
                </table>
                <div class="row mt-3">
                  <div class="col-12 p-2">
                    <div class="table-responsive">
                      <table id="table-kritik" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Layanan</th>
                            <th>Feedback</th>
                            <th>Tanggal</th>
                            <th>Kritik</th>
                          </tr>
                        </thead>
                        <tbody id="kritik-tbody">
                          <tr>
                            <td colspan="3"> Tidak ada data </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
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

  $('#kop-surat').hide();
  $('#card-laporan').hide();
  $('#card-kritik').hide();
  
  function getkategori(){
    var jqXHR = $.ajax({
      url: "{{ url('/get/kategori') }}",
      method: 'get',
      async: false,
      dataType: 'json'
    });

    return jqXHR.responseText;
  }

  var kategori = getkategori();
  var kategori = jQuery.parseJSON(kategori);

  if(kategori){
    var label = [];

    kategori.forEach(element => {
        label.push(element.name);
    });
  }

  $('#cari-data-laporan').on('click', function(){
    $('#card-filter').append('<div class="overlay" id="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i></div>');
    
    $("#laporan-tbody").empty();
    $("#kritik-tbody").empty();

    $('#card-laporan').hide();
    $('#card-kritik').hide();

    var question_id = $('#question_id').val();
    var service_id = $('#service_id').val();
    var tanggal_awal = $('#tanggal_awal').val();
    var tanggal_akhir = $('#tanggal_akhir').val();

    $.ajax({
        url: "{{ route('cari_laporan') }}",
        method: 'post',
        data: {
          _token: '{{ csrf_token() }}',
          question_id: question_id,
          service_id: service_id,
          tanggal_awal: tanggal_awal,
          tanggal_akhir: tanggal_akhir
        },
        dataType: 'json',
        success: function(data){
          var tanggal1 = data.tanggal_awal;
          var tanggal2 = data.tanggal_akhir;

          if(tanggal1 == tanggal2){
            var tanggal = moment(tanggal1).format("DD-MM-YYYY");
          }else{
            var tanggal1 = moment(tanggal1).format("DD-MM-YYYY");
            var tanggal2 = moment(tanggal2).format("DD-MM-YYYY");
            var tanggal = tanggal1+" s/d "+tanggal2;
          }

          var layanan = data.service.name;
          var pertanyaan = data.question.pertanyaan;
          var responden = data.count_survey;
          var responden_kritik = data.count_kritik_survey;

          $("#laporan_tanggal").text(tanggal);
          $("#laporan_layanan").text(layanan);
          $("#laporan_pertanyaan").text(pertanyaan);
          $("#laporan_responden").text(responden);

          $("#laporan_kritik_tanggal").text(tanggal);
          $("#laporan_kritik_layanan").text(layanan);
          $("#laporan_kritik_pertanyaan").text(pertanyaan);
          $("#laporan_kritik_responden").text(responden_kritik);

          if(data.laporan){
            data.laporan.forEach(items => {
              if(items.feedback == 3){
                var cat = 'Sangat Puas';
              }else if(items.feedback == 2){
                var cat = 'Puas';
              }else{
                var cat = 'Tidak Puas';
              }
  
              $('#table-laporan').find('tbody').append(
                "<tr><td>"+layanan+"</td><td>"+items.tanggal+"</td><td>"+cat+"</td><td>"+items.jumlah+"</td></tr>"
                );
            });
          }else{
            $('#table-laporan').find('tbody').append(
              "<tr><td colspan='4' align='center'>Tidak ada data</td></tr>"
            );
          }

          if(data.kritik_survey){
            data.kritik_survey.forEach(items => {
              var tanggal_kritik = items.created_at.split(' ')[0];
  
              if(items.feedback == 3){
                var cat = 'Sangat Puas';
              }else if(items.feedback == 2){
                var cat = 'Puas';
              }else{
                var cat = 'Tidak Puas';
              }
  
              $('#table-kritik').find('tbody').append(
                "<tr><td>"+items.name+"</td><td>"+cat+"</td><td>"+tanggal_kritik+"</td><td>"+items.kritik+"</td></tr>"
                );
            });
          }else{
            $('#table-kritik').find('tbody').append(
              "<tr><td colspan='4' align='center'>Tidak ada data</td></tr>"
            );
          }

          var feedback_sangat_puas = data.feedback_sangat_puas;
          var feedback_puas = data.feedback_puas;
          var feedback_cukup_puas = data.feedback_cukup_puas;
          var label_data = label;

          panggilChart(label_data, feedback_sangat_puas, feedback_puas, feedback_cukup_puas);

          $('#card-laporan').show();
          $('#card-kritik').show();
          $("#overlay").remove();
        }
    });
  });

  function panggilChart(label_data, feedback_sangat_puas, feedback_puas, feedback_cukup_puas){
    const doughnut_chart = document.getElementById('doughnut-chart');
    const bar_chart = document.getElementById('bar-chart');

    let chartStatus1 = Chart.getChart("doughnut-chart"); // <canvas> id
    let chartStatus2 = Chart.getChart("bar-chart"); // <canvas> id
    if (chartStatus1 != undefined) {
      chartStatus1.destroy();
    }
    if (chartStatus2 != undefined) {
      chartStatus2.destroy();
    }

    new Chart(doughnut_chart, {
      type: 'doughnut',
      data: {
        labels: label_data,
        datasets: [{
          label: '# of Survey',
          data: [feedback_sangat_puas, feedback_puas, feedback_cukup_puas],
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
              title: {
                  display: true,
                  text: 'Data Survey'
              }
          }
      }
    });

    new Chart(bar_chart, {
      type: 'bar',
      data: {
        labels: label,
        datasets: [{
          label: '# of Survey',
          data: [feedback_sangat_puas, feedback_puas, feedback_cukup_puas],
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: "Jumlah Survey"
            }
          }
        },
        plugins: {
              title: {
                  display: true,
                  text: 'Data Survey'
              }
          }
      }
    });
  }

  var tanggal_awal = $('#tanggal_awal').val();
	var tanggal_akhir = $('#tanggal_akhir').val();

	var tgl_awal= $("#tanggal_awal").val().split("-");
	var tanggal_awal_format = tgl_awal[2]+'/'+tgl_awal[1]+'/'+tgl_awal[0];

	var tgl_akhir= $("#tanggal_akhir").val().split("-");
	var tanggal_akhir_format = tgl_akhir[2]+'/'+tgl_akhir[1]+'/'+tgl_akhir[0];

	if(tanggal_awal){
		$('#range_tanggal').val(tanggal_awal_format + ' - ' + tanggal_akhir_format);
	}

  var start = moment();
	var end = moment();

  $('#range_tanggal').daterangepicker({
		buttonClasses: 'm-btn btn',
		applyClass: 'btn-primary',
		cancelClass: 'btn-secondary',
    opens: 'right',

		startDate: start,
		endDate: end,
		locale: {
      'separator': ' - ',
      'applyLabel': 'Pilih',
      'cancelLabel': 'Batal',
      'fromLabel': 'Dari',
      'toLabel': 'Sampai',
      'customRangeLabel': 'Pilih Range'
		},
		ranges: {
			'Hari Ini': [moment(), moment()],
			'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'7 Hari Lalu': [moment().subtract(6, 'days'), moment()],
			'30 Hari Lalu': [moment().subtract(29, 'days'), moment()],
			'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
			'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		}
	}, function(start, end, label) {
		  $('#range_tanggal').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
			$('#tanggal_awal').val(start.format('YYYY-MM-DD'));
			$('#tanggal_akhir').val(end.format('YYYY-MM-DD'));
	});

  function printLaporan() {
    var styles = `
      @media print {
        body {
          visibility: hidden;
        }
        #card-laporan {
          visibility: visible;
          left: 0;
          top: 0;
        }
        #kop-surat {
          visibility: visible;
        }
        #button-laporan {
          display: none;
        }
      }
    `

    var styleSheet = document.createElement("style")
    styleSheet.innerText = styles
    document.head.appendChild(styleSheet)

    $('#card-filter').hide();
    $('#card-kritik').hide();

    $('#kop-surat').show();

    window.print();

    window.onafterprint = function(){
      $('#kop-surat').hide();
      $('#card-filter').show();
      $('#card-kritik').show();
    }
  }

  function printKritik() {
    var styles = `
      @media print {
        body {
          visibility: hidden;
        }
        #card-kritik {
          visibility: visible;
          left: 0;
          top: 0;
        }
        #kop-surat {
          visibility: visible;
        }
        #button-kritik {
          display: none;
        }
      }
    `

    var styleSheet = document.createElement("style")
    styleSheet.innerText = styles
    document.head.appendChild(styleSheet)

    $('#card-filter').hide();
    $('#card-laporan').hide();

    $('#kop-surat').show();

    window.print();

    window.onafterprint = function(){
      $('#kop-surat').hide();
      $('#card-filter').show();
      $('#card-laporan').show();
    }
  }
</script>
@endsection