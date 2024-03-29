<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') | SGT Bird Farm</title>
    <link rel="icon" href="{{ asset('logo/logo.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/dist/css/adminlte.min.css">
    {{-- tables --}}
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('admin-lte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- Sweetalert --}}
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

</head>

<body class="  hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="" alt="AdminLTELogo" height="60" width="60">

            <div class="animation__shake" style="text-align:center">
                <h4><b>SGT Bird Farm</b></h4>
                LOADING...
            </div>
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @include('admin-lte.navbar')
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('logo/logo.png') }}" alt="SGT Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">SGT Bird Farm</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    {{-- <div class="image">
                        <img src="{{ asset('template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div> --}}
                    <div class="info">
                        <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->nama_lengkap }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <!-- Sidebar Menu -->
                    @include('admin-lte.sidebar')
                    <!-- /.sidebar-menu -->
                </nav>
            </div>
            <!-- /.sidebar -->

        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">
                                    @yield('title')</li>
                            </ol>

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                @yield('content')
                <div class="modal fade" id="modal-sm">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Logout</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p> Apakah anda ingin keluar ??</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <ion-icon name="exit-outline"></ion-icon> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </section>
            <!-- /.content -->
            {{-- Dynamic Modal --}}
            <div class="modal fade " id="showModal">
                <div class="modal-dialog modal-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLabel"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="showModalBody">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @include('admin-lte.footer')
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    {{-- Sweet Alert --}}
    @include('sweetalert::alert')
    <!-- jQuery -->
    <script src="{{ asset('admin-lte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin-lte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-lte') }}/dist/js/adminlte.js"></script>
    {{-- icon --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('admin-lte') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    {{-- data Tables --}}
    <script src="{{ asset('admin-lte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <!-- OPTIONAL SCRIPTS -->

    @stack('js')
    <script>
        $(document).ready(function() {
            getNotifikasi();
        });

        function getNotifikasi() {
            $.get("{{ url('/get-notifications') }}", function(data) {
                $('#notifikasi').html(data);
            });
        }
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher('4dc966f2b3a43db8ed26', {
            cluster: 'ap1',
            channelAuthorization: {
                endpoint: '/broadcasting/auth',
                headers: {
                    "X-CSRF-Token": "{{ csrf_token() }}",
                },
            },
        });
        // var channel = pusher.subscribe('notif-user');
        var channel = pusher.subscribe('private-notif-user.' + {{ Auth::user()->id }});
        channel.bind('notif-user', function(data) {
            // alert(JSON.stringify(data));
            getNotifikasi();
        });
    </script>

</body>

</html>
