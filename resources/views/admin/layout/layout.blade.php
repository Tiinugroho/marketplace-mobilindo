<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:07:52 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Admin Mobilindo | @yield('title')</title>


    <!--[if lt IE 10]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico"
        type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/web/css/waves.min.css') }}" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/feather.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/font-awesome-n.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/datatables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/buttons.datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/autofill.datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/select.datatables.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/web/css/chartist.css') }}" type="text/css" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap4-toggle/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/web/css/widget.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('admin.layout.navbar')
            @include('admin.layout.sidebar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @php
                        $url = url()->current();
                        $path = parse_url($url, PHP_URL_PATH);
                        $segments = explode('/', trim($path, '/'));
                        $firstSegment = $segments[0] ?? null;
                        $secondSegment = $segments[1] ?? null;
                    @endphp

                    <nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigation-label">Main Menu</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="{{ $firstSegment == 'dashboard' ? 'pcoded-trigger' : '' }}">
                                        <a href="{{ '/dashboard' }}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                            <span class="pcoded-mtext">Dashboard</span>
                                        </a>
                                    </li>
                                </ul>

                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller')
                                    <div class="pcoded-navigation-label">Katalog</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        @if (Auth::user()->role == 'admin')
                                            <li class="{{ $firstSegment == 'kategori' ? 'pcoded-trigger' : '' }}">
                                                <a href="{{ '/kategori' }}" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                                                    <span class="pcoded-mtext">Kategori Mobil</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="{{ $firstSegment == 'produk' ? 'pcoded-trigger' : '' }}">
                                            <a href="{{ '/produk' }}" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                                                <span class="pcoded-mtext">List Mobil</span>
                                            </a>
                                        </li>
                                    </ul>
                                @endif

                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="{{ $firstSegment == 'reservasi' ? 'pcoded-trigger' : '' }}">
                                        <a href="{{ url('/reservasi') }}" class="waves-effect waves-dark">
                                            @php
                                                $countBooking = \App\Models\Booking::whereHas('produk', function (
                                                    $query,
                                                ) {
                                                    $query->where('seller_id', auth()->id());
                                                })
                                                    ->where('booking_status', 'pending')
                                                    ->count();
                                            @endphp
                                            <span class="pcoded-micon"><i
                                                    class="feather icon-alert-octagon"></i></span>
                                            <span class="pcoded-mtext">Data Booking</span>
                                            <span class="pcoded-badge label label-warning ">{{ $countBooking }}</span>
                                        </a>
                                    </li>
                                </ul>

                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller')
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="{{ $firstSegment == 'mutasi' ? 'pcoded-trigger' : '' }}">
                                            <a href="{{ '/mutasi' }}" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-file"></i></span>
                                                <span class="pcoded-mtext">Laporan Mutasi</span>
                                            </a>
                                        </li>
                                    </ul>
                                @endif

                                @if (Auth::user()->role == 'admin')
                                    <div class="pcoded-navigation-label">Management</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                                                <span class="pcoded-mtext">Users</span>
                                            </a>
                                            <ul class="pcoded-submenu"
                                                style="{{ $firstSegment == 'user' ? 'block' : '' }}">
                                                <li class="{{ $secondSegment == 'seller' ? 'active' : '' }}">
                                                    <a href="{{ '/seller' }}" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Seller</span>
                                                    </a>
                                                </li>
                                                <li class="{{ $secondSegment == 'customer' ? 'active' : '' }}">
                                                    <a href="{{ '/customer' }}" class="waves-effect waves-dark">
                                                        <span class="pcoded-mtext">Customer</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </nav>

                    @yield('content')

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Script SweetAlert -->
    <script>
        // Konfirmasi Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data ini tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if (session('delete'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Dihapus',
                    text: "{{ session('delete') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });
    </script>

    <script data-cfasync="false" src="{{ asset('admin/web/js/email-decode.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('admin/web/js/waves.min.js') }}"></script>

    <script src="{{ asset('admin/web/js/jquery.slimscroll.js') }}"></script>

    <script src="{{ asset('admin/web/js/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/web/js/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('admin/web/js/curvedlines.js') }}"></script>
    <script src="{{ asset('admin/web/js/jquery.flot.tooltip.min.js') }}"></script>

    <script src="{{ asset('admin/web/js/chartist.js') }}"></script>

    <script src="{{ asset('admin/web/js/amcharts.js') }}"></script>
    <script src="{{ asset('admin/web/js/serial.js') }}"></script>
    <script src="{{ asset('admin/web/js/light.js') }}"></script>

    <script src="{{ asset('admin/web/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/vertical-layout.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/custom-dashboard.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/script.min.js') }}"></script>

    <script type="5d9ba7efeedeae317f2b80fb-text/javascript" src="{{asset('admin/web/js/css-scrollbars.js')}}"></script>

    <script src="{{ asset('admin/web/js/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/web/js/datatables.autofill.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/datatables.select.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/datatables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/web/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('admin/web/js/extensions-custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script type="d2d1d6e2f87cbebdf4013b26-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script>
    <script src="{{ asset('admin/web/js/rocket-loader.min.js') }}" data-cf-settings="d2d1d6e2f87cbebdf4013b26-|49"
        defer=""></script>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:25 GMT -->

</html>
