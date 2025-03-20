@extends('admin.layout.layout')
@section('title', 'List Kategori')
@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-inbox bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>@yield('title')</h5>
                        <span>Data Kategori secara lengkap</span>
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
                                        <a href="{{route('kategori.create')}}" class="btn btn-primary text-white">
                                            <i class="feather icon-plus"></i>Tambah Kategori
                                        </a>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Nama Kategori
                                                    </th>
                                                    <th>
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kategoris as $kategori)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $kategori->name }}</td>
                                                        <td>
                                                            <!-- Tombol Edit -->
                                                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                                                                class="btn waves-effect waves-light btn-success btn-icon mr-1">
                                                                <i class="fa-solid fa-pen-to-square mr-0"></i>
                                                            </a>

                                                            <!-- Tombol Hapus dengan SweetAlert -->
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger btn-icon"
                                                                onclick="confirmDelete({{ $kategori->id }})">
                                                                <i class="fa fa-trash-alt mr-0"></i>
                                                            </button>

                                                            <!-- Form Hapus (Hidden) -->
                                                            <form id="delete-form-{{ $kategori->id }}"
                                                                action="{{ route('kategori.destroy', $kategori->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
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

        <div id="styleSelector"></div>
    </div>
</div>
@endsection
