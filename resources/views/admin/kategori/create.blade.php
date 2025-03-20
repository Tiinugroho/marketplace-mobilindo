@extends('admin.layout.layout')
@section('title', 'Tambah Kategori')
@section('content')
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-inbox bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>@yield('title')</h5>
                            <span>Form untuk menambah kategori baru</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
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
                                            <h5>Form Tambah Kategori</h5>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <form action="{{ route('kategori.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Nama Kategori</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <a href="{{ route('kategori.index') }}"
                                                    class="btn btn-secondary">Kembali</a>
                                            </div>
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
