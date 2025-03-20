@extends('admin.layout.layout')
@section('title', 'Edit Kategori')
@section('content')
    <div class="pcoded-content">
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-inbox bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>@yield('title')</h5>
                            <span>Edit data kategori yang ada</span>
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
                                            <h5>Edit Kategori</h5>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <form id="edit-kategori-form" action="{{ route('kategori.update', $kategori->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT') <!-- Menggunakan metode PUT untuk update -->
                                            <div class="form-group">
                                                <label for="name">Nama Kategori</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    value="{{ $kategori->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update</button>
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

    <script>
        // SweetAlert konfirmasi sebelum submit
        document.getElementById('edit-kategori-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form terkirim langsung

            // SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Perubahan pada kategori akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user menekan "Ya, perbarui!"
                    e.target.submit(); // Kirim form
                }
            });
        });
    </script>
@endsection
