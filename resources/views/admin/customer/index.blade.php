@extends('admin.layout.layout')
@section('title', 'List Customer')
@section('content')
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-users bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>@yield('title')</h5>
                        <span>Data Customer secara lengkap</span>
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
                                    <h5>Data @yield('title')</h5>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Nomor HP</th>
                                                    <th>Alamat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customers as $key => $customer)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $customer->name }}</td>
                                                        <td>{{ $customer->email }}</td>
                                                        <td>{{ $customer->phone }}</td>
                                                        <td>{{ $customer->address }}</td>
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
