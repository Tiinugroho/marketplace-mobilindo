@extends('admin.layout.layout')
@section('title', 'List Mutasi')
@section('content')
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-calendar bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>@yield('title')</h5>
                            <span>Data Mutasi secara lengkap</span>
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
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data @yield('title')</h5>
                                        <a href="{{ route('mutasi.pdf') }}" class="btn btn-success">Cetak PDF</a><!-- Form Input Tanggal -->
                                        <form action="{{ route('mutasi.pdf') }}" method="GET" class="form-inline mt-3">
                                            <label for="start_date" class="mr-2">Dari:</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control mr-2" required>
                                            <label for="end_date" class="mr-2">Sampai:</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control mr-2" required>
                                            <button type="submit" class="btn btn-success">Cetak PDF</button>
                                        </form>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="autofill" class="table table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Transaksi</th>
                                                        @if (Auth::user()->role == 'admin')
                                                            <th>Penjual</th>
                                                        @endif
                                                        <th>Pemesan</th>
                                                        <th>Produk</th>
                                                        <th>Total Harga</th>
                                                        <th>Tanggal</th>
                                                        <th>Status Booking</th>
                                                        <th>Status Pembayaran</th>
                                                        <th>Tipe Pembayaran</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookings as $booking)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $booking->code_transaction }}</td>
                                                            @if (Auth::user()->role == 'admin')
                                                                <td>{{ $booking->produk->seller->name }}</td>
                                                            @endif
                                                            <td>{{ $booking->buyer->name }}</td>
                                                            <td>{{ $booking->produk->brand }}
                                                                {{ $booking->produk->model }}
                                                            </td>
                                                            <td>Rp
                                                                {{ number_format($booking->total_price, 0, '.', '.') }}
                                                            </td>
                                                            <td>{{ $booking->date }}</td>
                                                            <td>
                                                                <span
                                                                    class="badge p-2
                                                            {{ $booking->booking_status == 'pending' ? 'badge-warning' : '' }}
                                                            {{ $booking->booking_status == 'completed' ? 'badge-success' : '' }}
                                                            {{ $booking->booking_status == 'canceled' ? 'badge-danger' : '' }}">
                                                                    {{ ucfirst($booking->booking_status) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge p-2
                                                            {{ $booking->payment_status == 'unpaid' ? 'badge-danger' : 'badge-success' }}">
                                                                    {{ ucfirst($booking->payment_status) }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $booking->type_payment }}</td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
