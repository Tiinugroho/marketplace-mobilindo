@extends('admin.layout.layout')
@section('title', 'Tambah Produk')
@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-plus bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>@yield('title')</h5>
                        <span>Form untuk menambahkan produk baru</span>
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
                                    <h5>Form @yield('title')</h5>
                                </div>
                                <div class="card-block">
                                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input type="text" name="brand" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Model</label>
                                            <input type="text" name="model" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="number" name="year" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" name="price" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="3" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="available">Tersedia</option>
                                                <option value="unavailable">Tidak Tersedia</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <input type="file" name="image" class="form-control-file" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
                                    </form>
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
