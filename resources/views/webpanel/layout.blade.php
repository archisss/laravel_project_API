<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>car-E - Panel de Arrendador</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" href="{!! asset('dist/img/care.png') !!}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('webpanel.importlibs')
  
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('webpanel.webpanelnav')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/login') }}" class="brand-link brand-text">
      <img src="{{ asset('dist/img/Carelogo.png') }}"
           alt="Car-E"
           class="brand-image rounded elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light" style="visibility: hidden">Car-E</span>
    </a>
    @include('webpanel.sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
           <!-- <h1>Blank Page</h1> -->
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>-->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')
        @if(isset($msj_bienvenida))
          {{ $msj_bienvenida }}
        @endif
        @yield('page-script')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('webpanel.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYDsjRF5FFD3FRJY57931NZKx11xd5xbw&libraries=places"></script>-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>





<!-- SlimScroll 
<script src="/dist/js/slimScroll/jquery.slimscroll.min.js"></script>-->
<!-- FastClick 
<script src="/dist/js/fastclick/fastclick.js"></script>-->
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>



</body>
</html>