<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script type="text/javascript" src="{{ URL::to('js/demo/chart-area-demo.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/demo/chart-pie-demo.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Bootstrap & CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="css/sb-admin-2.css">
    <link rel="stylesheet" type="text/css" href="css/sb-admin-2.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Custom styles for table -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

     <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            @if(auth()->user()->role=='pemilik')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/pemilik">
            @elseif(auth()->user()->role=='kasir')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            @endif
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-Kasir</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if(auth()->user()->role=='pemilik')
            <li class="nav-item active">
                    <a class="nav-link" href="/pemilik">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
                @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                @if (auth()->user()->role=='pemilik')
                    pemilik
                @else
                    kasir
                @endif
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Barang</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Barang :</h6>

                        @if(auth()->user()->role=='pemilik')
                            <a class="collapse-item" href="/kategori_pemilik">List Kategori</a>
                            <a class="collapse-item" href="/listbarang_pemilik">List Barang</a>
                            <a class="collapse-item" href="/liststok_pemilik">List Stok Barang</a>
                        @else
                            <a class="collapse-item" href="/kategori_kasir">List Kategori</a>
                            <a class="collapse-item" href="/listbarang_kasir">List Barang</a>
                            <a class="collapse-item" href="/liststok_kasir">List Stok Barang</a>
                        @endif
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan :</h6>
                        @if(auth()->user()->role=='pemilik')
                            <a class="collapse-item" href="/lap_penjualan_pemilik">Laporan Penjualan</a>
                            <a class="collapse-item" href="/lap_laba_pemilik">Laporan Laba</a>
                            <a class="collapse-item" href="/lap_barang_pemilik">Laporan Barang</a>
                        @else
                            <a class="collapse-item" href="/lap_penjualan_kasir">Laporan Penjualan</a>
                            <a class="collapse-item" href="/lap_barang_kasir">Laporan Barang</a>
                        @endif
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/pos">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Menu Kasir</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                            @if($notif > 0)
                                <span class="badge badge-danger badge-counter">{{ $notif }}</span>
                            @endif
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Barang Kadaluarsa
                                </h6>
                                <div id="notif">
                                    @foreach ($isi as $item)
                                        <i class="dropdown-item d-flex align-items-center" style="pointer-events:none;">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">{{ $item->nama_barang }}</div>
                                                <div class="small text-gray-500">{{ $item->tanggal_kadaluarsa }}</div>
                                            </div>
                                        </i>
                                    @endforeach
                                </div>
                                @if(auth()->user()->role=='pemilik')
                                    <a class="dropdown-item text-center small text-gray-600" href="/stok_kadaluarsa">Daftar Barang Kadaluarsa</a>
                                @endif
                                
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">@yield('user')</span>
                                <img class="img-profile rounded-circle" src="/image/cat.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> --}}
                                {{-- <div class="dropdown-item"></div> --}}
                                <a class="dropdown-item" href="/logout">
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                    @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')

</body>

@section('scripts')

    <script type="text/javascript">

        $(".update-status").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            loading.show();

            $.ajax({
                url: '{{ url('update-status') }}' + '/' + ele.attr("data-item-id_stok_notif"),
                method: "GET",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {
                    loading.hide();

                    $("#notif").html(response.data);
                    console.log(response.data);
                }
            });
        });

        // $(".update-status").click(function (e) {
        //     e.preventDefault();
        //     var ele = $(this);
        //     ele.siblings('.btn-loading').show();

        //     $.ajax({
        //         url: '{{ url('update-status') }}' + '/' + ele.attr("data-item-id_stok"),
        //         method: "GET",
        //         data: {_token: '{{ csrf_token() }}'},
        //         dataType: "json",
        //         success: function (response) {
        //             ele.siblings('.btn-loading').hide();
        //             $("#header-bar").html(response.data);
        //             console.log(response.data);
        //         },
        //         statusCode:{
        //             500:function(e){
        //                 console.log(e.responseText);
        //             }
        //         }
        //     });
        // });
    </script>
@stop
</html>
