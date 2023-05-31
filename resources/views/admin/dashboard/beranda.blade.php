@extends('admin.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
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
          <div class="card" id="card-laporan">
            @if (session()->has('success'))
              <div id="session" data-type="success" data-session=" {{ session('success') }}"></div>
            @endif
            @if (session()->has('error'))
              <div id="session" data-type="error" data-session=" {{ session('error') }}"></div>
            @endif
            <div class="card-body">
              <h4>Hari/Tanggal : {{ date('d-m-Y', strtotime($tanggal)) }}</h4>
              <hr>
              <div class="row mt-3">
                <?php 
                  $total = 0;  
                ?>
                @foreach ($laporan as $report)
                <?php
                  $total += $report->jumlah; 
                ?>
                @endforeach

                <?php 
                  $jumlah = 0;  
                ?>
                @foreach ($laporan as $report)
                <?php
                  $jumlah += $report->jumlah; 
                ?>
                <div class="col-3">
                  @if ($report->feedback == 1)
                  <div class="callout callout-danger">  
                  @elseif ($report->feedback == 2)
                  <div class="callout callout-warning">
                  @elseif ($report->feedback == 3)
                  <div class="callout callout-success">
                  @endif
                    <h5>
                      @foreach ($feedback as $fd)
                          @if ($fd['id'] == $report->feedback)
                              {{ $fd['name'] }}
                          @break
                          @endif
                      @endforeach
                    </h5>
  
                    <h1>{{ $report->jumlah }}</h1>
                    <?php
                      $persentase = ($report->jumlah / $total)*100;
                    ?>
                      <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
                             aria-valuenow="<?php echo $persentase; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentase; ?>%">
                          <span class="sr-only"><?php echo $persentase; ?>% Complete</span>
                        </div>
                      </div>
                  </div>
                </div>
                @endforeach
                <div class="col-3">
                  <div class="callout callout-info">
                    <h5>Total Survey</h5>
  
                    <h1>{{ $jumlah }}</h1>
                      <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                          <span class="sr-only">100% Complete</span>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3 gx-2">
                <div class="col-6">
                  <canvas id="doughnut-chart"></canvas>
                </div>
                <div class="col-6">
                  <canvas id="bar-chart"></canvas>
                </div>
              </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
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

  var feedback_sangat_puas = {{ $feedback_sangat_puas }};
  var feedback_puas = {{ $feedback_puas }};
  var feedback_cukup_puas = {{ $feedback_cukup_puas }};

  if(kategori){
    var label = [];

    kategori.forEach(element => {
        label.push(element.name);
    });

    console.log(label);
    panggilChart(label, feedback_sangat_puas, feedback_puas, feedback_cukup_puas);

  }

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
          data: [feedback_cukup_puas, feedback_puas, feedback_sangat_puas],
          backgroundColor: [
            'rgba(255, 159, 64, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgba(255, 159, 64, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)'
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
          data: [feedback_cukup_puas, feedback_puas, feedback_sangat_puas],
          backgroundColor: [
            'rgba(255, 159, 64, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgba(255, 159, 64, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)'
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
</script>
@endsection