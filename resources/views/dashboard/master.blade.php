<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  @yield('page_title') {{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    
    <link rel="stylesheet" href="{{ asset('dash/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dash/css/adminlte.min.css') }}">
    @stack('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('dashboard.extends.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  {{-- @include('dashboard.extends.aside') --}}
  <x-nav />

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-6">
                  <ol class="breadcrumb ">
                      @section('breadcrumb')
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      @show
                  </ol>
              </div>
          </div>

            @yield('page_info')

      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
      </div>
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Main Footer -->
  @include('dashboard.extends.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('dash/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dash/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dash/js/adminlte.min.js') }}"></script>
<script >
  const userID = "{{ Auth::id() }}";
</script>
<script src="{{ asset('/build/assets/app-a15348d6.js') }}"></script>

    @stack('scripts')
</body>
</html>
