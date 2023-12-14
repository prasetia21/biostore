@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Semua Voucher </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Semua Voucher</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.voucher') }}" class="btn btn-primary">Tambah Voucher</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Voucher </th>
                                <th>Nama Voucher </th>
                                <th>Deskripsi </th>
                                <th>Maksimal User </th>
                                <th>Maksimal Penggunaan </th>
                                <th>Type </th>
                                <th>Nominal </th>
                                <th>Valid Sampai </th>
                                <th>Status </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voucher as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $item->code }}</td>
                                    <td> {{ $item->name }}</td>
                                    <td> {{ $item->description }}</td>
                                    <td> {{ $item->max_uses }}</td>
                                    <td> {{ $item->max_uses_user }}</td>
                                    <td> {{ $item->type }}</td>
                                    <td> {{ $item->nominal }} Point </td>

                                    <td> {{ Carbon\Carbon::parse($item->expires_at)->format('D, d F Y') }} </td>


                                    <td>
                                        @if ($item->expires_at >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge rounded-pill bg-success">Valid</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Invalid</span>
                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('edit.voucher', $item->id) }}" class="btn btn-info">Edit</a>

                                        <a href="{{ route('delete.voucher', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Voucher </th>
                                <th>Nama Voucher </th>
                                <th>Deskripsi </th>
                                <th>Maksimal User </th>
                                <th>Maksimal Penggunaan </th>
                                <th>Type </th>
                                <th>Nominal </th>
                                <th>Valid Sampai </th>
                                <th>Status </th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
