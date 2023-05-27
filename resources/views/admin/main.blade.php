<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }} | Survey Kepuasan Pelanggan</title>
  <link rel="icon" href="{{ asset('assets/img/logo.png') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
  {{-- Trix Editor --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/trix.css') }}">
  <!-- Drag and Drop -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dnd-style.css') }}">
  <!-- SweetAlert2 CSS -->
  <link href="{{ asset('assets/dist/css/sweetalert2.css') }}" rel="stylesheet">
  
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
  
  <!-- jQuery -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('assets/img/logo.png') }}" alt="AdminLTELogo" width="150">
      {{-- <img class="animation__shake" src="{{ asset('assets/brand/logo-panjang-gelap.png') }}" alt="AdminLTELogo"> --}}
    </div>

    {{-- Navbar --}}
    @include('admin.component.navbar')
    
    {{-- Sidebar --}}
    @include('admin.component.sidebar')
    
    @yield('content')
    
    {{-- Footer --}}
    @include('admin.component.footer')

</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
{{-- <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script> --}}

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert 2 -->
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{ asset('assets/dist/js/sweetalert2.all.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<!-- Trix Editor -->
<script type="text/javascript" src="{{ asset('assets/js/trix.js') }}"></script>

<script type="text/javascript">
$("#logout").on("click", function() {
    Swal.fire({
      title: 'Perhatian!',
      text: 'Apakah anda ingin logout ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Lanjut'
    }).then((result) => { 
        if (result.value===true) { 
          $('#logoutForm').submit() // this submits the form 
        } 
    }) 
})
</script>

@yield('javascript')

</body>
</html>