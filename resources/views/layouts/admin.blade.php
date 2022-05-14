<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>K-NN SYSTEM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.css') }}">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> --}}
  <link rel="stylesheet" href="{{ asset('assets\sweet\sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets\sweet\animate.css') }}">
  <!-- Google Font: Source Sans Pro -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    *::-webkit-scrollbar {
      width: 5px;
    }

    *::-webkit-scrollbar-track {
      background: transparent;
    }

    *::-webkit-scrollbar-thumb {
      background-color: #b3b3b3;
      border-radius: 10px;
      border: 0px;
    }
  </style>
  @yield('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item d-inline-flex">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          <p style="font-size: 1.7em;" class="my-0">
            <?php if (isset($title)) { ?>
              <?= $title ?>
            <?php } ?>
          </p>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">K-NN SYSTEM</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name}}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ url('home') }}" class="nav-link @yield('dashboard')">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview @yield('mo-prediction')">
              <!--menu-open -->
              <a href="#" class="nav-link @yield('prediction')">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p>
                  Prediction
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('tambah') }}" class="nav-link @yield('tambah')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Data</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('c-matrix') }}" class="nav-link @yield('c-matrix')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Confution Matrix</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('ed-data') }}" class="nav-link @yield('ed-data')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Euclidean Distance</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview @yield('mo-data-latih')">
              <!--menu-open -->
              <a href="#" class="nav-link @yield('data-latih')">
                <i class="fa fa-database" aria-hidden="true"></i>
                <p>
                  Training Data
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('e-data-latih') }}" class="nav-link @yield('e-data-latih')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Evaluation Data</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('n-data-latih') }}" class="nav-link @yield('n-data-latih')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Normalisasi</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview @yield('mo-test-data')">
              <!--menu-open -->
              <a href="#" class="nav-link @yield('test-data')">
                <i class="fa fa-server" aria-hidden="true"></i>
                <p>
                  Test Data
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('e-data') }}" class="nav-link @yield('e-test-data')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Evaluation Data</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('n-data') }}" class="nav-link @yield('n-test-data')">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Normalisasi</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link @yield('user')">
                <i class="nav-icon far fa-id-card"></i>
                <p>
                  Users Setting
                </p>
              </a>
            </li>
            <li class="nav-item mt-3">
              <a href="{{ route('home.guest') }}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  BACK TO HOMEPAGE
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();" class="nav-link">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  LOGOUT
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 <a href="#">Company</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.0-beta.2
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets\jq-ajax-progress\src\jq-ajax-progress.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte3.2.0.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  {{-- <script src="https://adminlte.io/themes/v3/dist/js/demo.js"></script> --}}
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
  {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
  <script src="{{ asset('assets\sweetalert2\dist\sweetalert2.all.js')}}"></script>
  {{-- <script src="{{ asset('assets\sweet\sweetalert2.all.js')}}"></script> --}}
  {{-- <script src="sweetalert2\src\SweetAlert.js"></script> --}}
  @yield('script')
  <script>
    $(function() {
      $('.table.table-search').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
      $('.table-nosearch').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>
</body>

</html>