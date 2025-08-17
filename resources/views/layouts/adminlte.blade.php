<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css') }}">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script src="/assets/js/handle.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('AdminLTE-3.2.0/dist/img/AdminLTELogo.png') }}"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Trang chủ</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Liên hệ</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('AdminLTE-3.2.0/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('AdminLTE-3.2.0/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('AdminLTE-3.2.0/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('AdminLTE-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="position: relative;">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
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

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    Doanh nghiệp
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.typical_business.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Doanh nghiệp</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.typical_business.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Doanh nghiệp</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    Banner trang dự án
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.project.createBanner') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Banner</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.project.indexBanner') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Banner</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Người dùng
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Người dùng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Người dùng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Tin tức
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.news.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Tin tức</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.news.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Tin tức</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Dự án
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.project.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Dự án</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.project.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>
                                    Bài đăng
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.properties.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Bài đăng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.properties.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Bài đăng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-crown"></i>
                                <p>
                                    Đăng ký VIP
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.vip_users.indexListLevel') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh mục VIP</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.vip_users.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Đăng ký VIP</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.vip_users.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Đăng ký VIP</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <div style="position: absolute; bottom: 4px; left: 4px;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link">Đăng
                            xuất</button>
                    </form>
                </div>
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
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
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
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/pages/dashboard.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                }
            })
            .catch(error => {
                console.error(error);
            });

        function loadQuan(idtinh) {
            return new Promise(resolve => {
                $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(data_quan) {
                    if (data_quan.error == 0) {
                        $("#quan").html('<option value="0">Quận Huyện</option>');
                        $("#phuong").html('<option value="0">Phường Xã</option>');
                        $.each(data_quan.data, function(key_quan, val_quan) {
                            $("#quan").append('<option value="' + val_quan.id + '" data-name="' +
                                val_quan.full_name + '">' + val_quan.full_name + '</option>');
                        });
                    }
                    resolve();
                });
            });
        }

        function loadPhuong(idquan) {
            return new Promise(resolve => {
                $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(data_phuong) {
                    if (data_phuong.error == 0) {
                        $("#phuong").html('<option value="0">Phường Xã</option>');
                        $.each(data_phuong.data, function(key_phuong, val_phuong) {
                            $("#phuong").append('<option value="' + val_phuong.id +
                                '" data-name="' +
                                val_phuong.full_name + '">' + val_phuong.full_name + '</option>'
                            );
                        });
                    }
                    resolve();
                });
            });
        }

        // Hàm này gọi sau khi đã render option tỉnh
        async function setLocationDefault(tinhName, quanName, phuongName) {
            // Set tỉnh
            let tinhId = null;
            $('#tinh option').each(function() {
                if (($(this).data('name') || '').toString().trim() === tinhName.trim()) {
                    tinhId = $(this).val();
                    $('#tinh').val(tinhId).trigger('change');
                    $('#tinh_name').val(tinhName);
                    return false;
                }
            });
            if (!tinhId) return;

            // Đợi quận load xong
            await loadQuan(tinhId);

            // Set quận
            let quanId = null;
            $('#quan option').each(function() {
                if (($(this).data('name') || '').toString().trim() === quanName.trim()) {
                    quanId = $(this).val();
                    $('#quan').val(quanId).trigger('change');
                    $('#quan_name').val(quanName);
                    return false;
                }
            });
            if (!quanId) return;

            // Đợi phường load xong
            await loadPhuong(quanId);

            // Set phường
            $('#phuong option').each(function() {
                if (($(this).data('name') || '').toString().trim() === phuongName.trim()) {
                    $('#phuong').val($(this).val());
                    $('#phuong_name').val(phuongName);
                    return false;
                }
            });
        }

        jQuery(document).ready(function($) {
            // Lấy tỉnh thành
            $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
                if (data_tinh.error == 0) {
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        $("#tinh").append('<option value="' + val_tinh.id + '" data-name="' +
                            val_tinh.full_name + '">' + val_tinh
                            .full_name + '</option>');
                    });

                    $("#tinh").on('change', function() {
                        var idtinh = $(this).val();
                        var nameTinh = $(this).find('option:selected').data('name');
                        $('#tinh_name').val(nameTinh);
                        $('#quan_name').val('');
                        $('#phuong_name').val('');
                        $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(
                            data_quan) {
                            if (data_quan.error == 0) {
                                $("#quan").html('<option value="0">Quận Huyện</option>');
                                $("#phuong").html('<option value="0">Phường Xã</option>');

                                $.each(data_quan.data, function(key_quan, val_quan) {
                                    $("#quan").append('<option value="' + val_quan
                                        .id + '" data-name="' +
                                        val_quan.full_name + '">' + val_quan
                                        .full_name +
                                        '</option>');
                                });

                                $("#quan").off('change').on('change', function() {
                                    var idquan = $(this).val();
                                    var nameQuan = $(this).find('option:selected')
                                        .data('name');
                                    $('#quan_name').val(nameQuan);
                                    $('#phuong_name').val('');
                                    $.getJSON('https://esgoo.net/api-tinhthanh/3/' +
                                        idquan + '.htm',
                                        function(data_phuong) {
                                            if (data_phuong.error == 0) {
                                                $("#phuong").html(
                                                    '<option value="0">Phường Xã</option>'
                                                );
                                                $.each(data_phuong.data,
                                                    function(key_phuong,
                                                        val_phuong) {
                                                        $("#phuong").append(
                                                            '<option value="' +
                                                            val_phuong
                                                            .id +
                                                            '"  data-name="' +
                                                            val_phuong
                                                            .full_name +
                                                            '">' +
                                                            val_phuong
                                                            .full_name +
                                                            '</option>');
                                                    });
                                            }
                                        });
                                });
                                $('#phuong').on('change', function() {
                                    var namePhuong = $(this).find('option:selected')
                                        .data('name');
                                    $('#phuong_name').val(namePhuong);
                                });
                            }
                        });
                    });
                    if (window.locationDefault) {
                        setLocationDefault(window.locationDefault.tinh, window.locationDefault.quan, window
                            .locationDefault.phuong);
                    }
                }
            });

            // Xử lý hiển thị ảnh
            $('input[name="images[]"]').on('change', function(e) {
                var files = e.target.files;
                var $preview = $('#image-preview');
                var $errorDiv = $('#image-error');
                $preview.html(''); // Xóa ảnh cũ

                // Kiểm tra số lượng ảnh
                if (files.length < 4) {
                    $errorDiv.show();
                } else {
                    $errorDiv.hide();
                }

                $.each(files, function(index, file) {
                    if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                        return true; // continue
                    }

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = new Image();
                        img.src = e.target.result;

                        $(img).on('load', function() {
                            var canvas = $('<canvas>')[0];
                            var ctx = canvas.getContext('2d');
                            var maxWidth = 100,
                                maxHeight = 100;
                            var width = img.width,
                                height = img.height;

                            // Resize
                            if (width > height && width > maxWidth) {
                                height = Math.round((height * maxWidth) / width);
                                width = maxWidth;
                            } else if (height > maxHeight) {
                                width = Math.round((width * maxHeight) / height);
                                height = maxHeight;
                            }

                            canvas.width = width;
                            canvas.height = height;
                            ctx.drawImage(img, 0, 0, width, height);

                            var thumbnail = $('<img>')
                                .attr('src', canvas.toDataURL('image/jpeg'))
                                .addClass('rounded object-cover')
                                .css({
                                    width: '150px'
                                });

                            $preview.append(thumbnail);
                        });
                    };

                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

</body>

</html>
