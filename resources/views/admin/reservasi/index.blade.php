@extends('admin.layout.layout')
@section('title', 'List Reservasi')
@section('content')
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-calendar bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>@yield('title')</h5>
                            <span>Data Reservasi secara lengkap</span>
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
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="autofill" class="table table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Pemesan</th>
                                                        @if (Auth::user()->role == 'admin')
                                                            <th>Penjual</th>
                                                        @endif
                                                        <th>Produk</th>
                                                        <th>Total Harga</th>
                                                        <th>Tanggal</th>
                                                        <th>Bukti Pembayaran</th>
                                                        <th>Status Booking</th>
                                                        <th>Status Pembayaran</th>
                                                        <th>Tipe Pembayaran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookings as $booking)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $booking->code_transaction }}</td>
                                                            <td>{{ $booking->buyer->name }}</td>
                                                            @if (Auth::user()->role == 'admin')
                                                                <td>{{ $booking->produk->seller->name }}</td>
                                                            @endif
                                                            <td>{{ $booking->produk->brand }} {{ $booking->produk->model }}
                                                            </td>
                                                            <td>Rp {{ number_format($booking->total_price, 0, '.', '.') }}
                                                            </td>
                                                            <td>{{ $booking->date }}</td>
                                                            <td>
                                                                @if ($booking->payment_proof)
                                                                    <a href="{{ asset('storage/' . $booking->payment_proof) }}"
                                                                        target="_blank">Lihat Bukti</a>
                                                                @else
                                                                    Tidak ada
                                                                @endif
                                                            </td>
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
                                                            <td>
                                                                <select class="form-control type-payment"
                                                                    data-id="{{ $booking->id }}">
                                                                    <option value="dp"
                                                                        {{ $booking->type_payment == 'dp' ? 'selected' : '' }}>
                                                                        DP</option>
                                                                    <option value="lunas"
                                                                        {{ $booking->type_payment == 'lunas' ? 'selected' : '' }}>
                                                                        Lunas</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                @if ($booking->booking_status == 'pending' && $booking->payment_status == 'paid')
                                                                    <form
                                                                        action="{{ route('reservasi.approve', $booking->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-success btn-sm confirm-button"
                                                                            data-id="{{ $booking->id }}">
                                                                            <i class="feather icon-check"></i> Konfirmasi
                                                                        </button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ route('reservasi.cancel', $booking->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm cancel-button"
                                                                            data-id="{{ $booking->id }}">
                                                                            <i class="feather icon-x"></i> Cancel
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Konfirmasi perubahan payment type
            $('.type-payment').change(function() {
                var bookingId = $(this).data('id');
                var typePayment = $(this).val();

                Swal.fire({
                    title: 'Yakin ingin mengubah payment type?',
                    text: 'Perubahan akan langsung tersimpan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('reservasi.updateTypePayment') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: bookingId,
                                type_payment: typePayment
                            },
                            success: function(response) {
                                Swal.fire('Berhasil!',
                                        'Payment type berhasil diperbarui.', 'success')
                                    .then(() => location.reload());
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                            }
                        });
                    }
                });
            });

            // Konfirmasi persetujuan pembayaran
            $(document).ready(function() {
                // Konfirmasi persetujuan pembayaran
                $('.confirm-button').click(function(e) {
                    e.preventDefault();
                    var id = $(this).data('id'); // Ambil ID dari tombol
                    var url = "{{ route('reservasi.approve', ':id') }}".replace(':id', id);

                    Swal.fire({
                        title: 'Setujui pembayaran ini?',
                        text: 'Pembayaran akan dikonfirmasi.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Setujui!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    Swal.fire('Berhasil!',
                                            'Pembayaran telah disetujui.',
                                            'success')
                                        .then(() => location.reload());
                                },
                                error: function() {
                                    Swal.fire('Gagal!',
                                        'Terjadi kesalahan, coba lagi.',
                                        'error');
                                }
                            });
                        }
                    });
                });

                $('.cancel-button').click(function(e) {
                    e.preventDefault();
                    var id = $(this).data('id'); 
                    var url = "{{ route('reservasi.cancel', ':id') }}".replace(':id', id);

                    Swal.fire({
                        title: 'Tolak pembayaran ini?',
                        text: 'Pembayaran akan ditolak.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Tolak!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    Swal.fire('Dibatalkan!',
                                            'Pembayaran telah ditolak.',
                                            'success')
                                        .then(() => location.reload());
                                },
                                error: function() {
                                    Swal.fire('Gagal!',
                                        'Terjadi kesalahan, coba lagi.',
                                        'error');
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
