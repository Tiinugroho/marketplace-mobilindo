@extends('admin.layout.layout')
@section('title', 'Dashboard')
@section('content')

    <div class="pcoded-content">
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Dashboard</h5>
                            <span>Ringkasan data sistem</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">

                            @if (Auth::user()->role == 'admin')
                                <!-- Total Staff -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card prod-p-card card-blue">
                                        <div class="card-body">
                                            <div class="row align-items-center m-b-30">
                                                <div class="col">
                                                    <h6 class="m-b-5 text-white">Total Seller</h6>
                                                    <h3 class="m-b-0 f-w-700 text-white">{{ $totalStaff }}</h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user-tie text-c-blue f-18"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Client -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card prod-p-card card-green">
                                        <div class="card-body">
                                            <div class="row align-items-center m-b-30">
                                                <div class="col">
                                                    <h6 class="m-b-5 text-white">Total Client</h6>
                                                    <h3 class="m-b-0 f-w-700 text-white">{{ $totalClient }}</h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users text-c-green f-18"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Pendapatan -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card prod-p-card card-red">
                                        <div class="card-body">
                                            <div class="row align-items-center m-b-30">
                                                <div class="col">
                                                    <h6 class="m-b-5 text-white">Total Pendapatan</h6>
                                                    <h3 class="m-b-0 f-w-700 text-white">Rp
                                                        {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign text-c-red f-18"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Mobil -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card prod-p-card card-yellow">
                                        <div class="card-body">
                                            <div class="row align-items-center m-b-30">
                                                <div class="col">
                                                    <h6 class="m-b-5 text-white">Total Mobil</h6>
                                                    <h3 class="m-b-0 f-w-700 text-white">{{ $totalProduk }}</h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-car text-c-yellow f-18"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (Auth::user()->role == 'seller')
                                <!-- Total Mobil -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card prod-p-card card-blue">
                                        <div class="card-body">
                                            <div class="row align-items-center m-b-30">
                                                <div class="col">
                                                    <h6 class="m-b-5 text-white">Total Mobil Anda</h6>
                                                    <h3 class="m-b-0 f-w-700 text-white">{{ $totalProduk }}</h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-car text-c-blue f-18"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6">
                                    <div class="card prod-p-card card-red">
                                        <div class="card-body">
                                            <div class="row align-items-center m-b-30">
                                                <div class="col">
                                                    <h6 class="m-b-5 text-white">Total Pendapatan</h6>
                                                    <h3 class="m-b-0 f-w-700 text-white">Rp
                                                        {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign text-c-red f-18"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Grafik Pendapatan -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Grafik Pendapatan per Bulan</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="pendapatanChart"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- row end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Selamat Datang!",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('pendapatanChart');

            // Pastikan elemen canvas ada sebelum membuat chart
            if (ctx) {
                var chartContext = ctx.getContext('2d');

                var pendapatanData = {!! json_encode(array_values($pendapatanData)) !!};

                var pendapatanChart = new Chart(chartContext, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt',
                            'Nov', 'Des'
                        ],
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: pendapatanData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>

@endsection
