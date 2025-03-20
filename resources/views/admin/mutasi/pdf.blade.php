<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Mutasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ 'abel.jpg' }}" alt="Logo Perusahaan">
        <h2>INVOICE MUTASI</h2>
        <p>Rentang Tanggal: {{ request('start_date') }} - {{ request('end_date') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Pemesan</th>
                <th>Produk</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->code_transaction }}</td>
                    <td>{{ $booking->buyer->name }}</td>
                    <td>{{ $booking->produk->brand }} {{ $booking->produk->model }}</td>
                    <td>Rp {{ number_format($booking->total_price, 0, '.', '.') }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ ucfirst($booking->booking_status) }}</td>
                    <td>{{ ucfirst($booking->payment_status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
