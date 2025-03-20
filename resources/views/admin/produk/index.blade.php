@extends('admin.layout.layout')
@section('title', 'List Produk')
@section('content')
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-inbox bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>@yield('title')</h5>
                            <span>Data Produk secara lengkap</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
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
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5>Data @yield('title')</h5>
                                            @if (Auth::user()->role == 'seller')
                                                <a href="{{ route('produk.create') }}" class="btn btn-primary text-white">
                                                    <i class="feather icon-plus"></i>Tambah Produk
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="autofill" class="table table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        @if (Auth::user()->role == 'admin')
                                                            <th>Penjual</th>
                                                        @endif
                                                        <th>Gambar</th>
                                                        <th>Brand</th>
                                                        <th>Model</th>
                                                        <th>Kategori</th>
                                                        <th>Tahun</th>
                                                        <th>Harga</th>
                                                        <th>Status</th>
                                                        @if (Auth::user()->role == 'seller')
                                                            <th>Aksi</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produks as $produk)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            @if (Auth::user()->role == 'admin')
                                                                <td>{{ $produk->seller->name }}</td>
                                                            @endif
                                                            <td>
                                                                <img src="{{ asset('storage/' . $produk->image) }}"
                                                                    width="50">
                                                            </td>
                                                            <td>{{ $produk->brand }}</td>
                                                            <td>{{ $produk->model }}</td>
                                                            <td>{{ $produk->kategori->name }}</td>
                                                            <td>{{ $produk->year }}</td>
                                                            <td>Rp {{ number_format($produk->price, 0, ',', '.') }}</td>
                                                            <td>
                                                                <span
                                                                    class="badge {{ $produk->status == 'available' ? 'badge-success' : 'badge-danger' }}">
                                                                    {{ ucfirst($produk->status) }}
                                                                </span>
                                                            </td>
                                                            @if (Auth::user()->role == 'seller')
                                                                <td>
                                                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                                                        class="btn waves-effect waves-light btn-success btn-icon mr-1">
                                                                        <i class="fa-solid fa-pen-to-square mr-0"></i>
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn waves-effect waves-light btn-danger btn-icon"
                                                                        onclick="confirmDelete({{ $produk->id }})">
                                                                        <i class="fa fa-trash-alt mr-0"></i>
                                                                    </button>
                                                                    <form id="delete-form-{{ $produk->id }}"
                                                                        action="{{ route('produk.destroy', $produk->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </td>
                                                            @endif
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

            <div id="styleSelector"></div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Anda tidak dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
