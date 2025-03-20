<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="index.html">
                <img class="img-fluid w-50" src="abel.jpg" alt="Theme-Logo" />
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-prepend search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-append search-btn">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!"
                        onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()"
                        class="waves-effect waves-light" data-cf-modified-d2d1d6e2f87cbebdf4013b26-="">
                        <i class="full-screen feather icon-maximize"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('admin/web/jpg/avatar-4.jpg') }}" class="img-radius"
                                alt="User-Profile-Image">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut">

                            <li>
                                <a href="#" onclick="confirmLogout(event)">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                            </li>
                            <script>
                                function confirmLogout(event) {
                                    event.preventDefault(); // Mencegah aksi default

                                    Swal.fire({
                                        title: "Apakah Anda yakin?",
                                        text: "Anda akan keluar dari akun ini.",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Ya, Logout!",
                                        cancelButtonText: "Batal"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Redirect ke URL logout Laravel
                                            window.location.href = "{{ route('logout') }}";
                                        }
                                    });
                                }
                            </script>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
