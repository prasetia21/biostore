@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Lihat Paket Bundling</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Lihat Paket Bundling <span
                                class="badge rounded-pill bg-danger"> {{ count($pakets) }} </span> </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.paket') }}" class="btn btn-primary">Tambah Paket Bundling</a>
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
                                <th>Image </th>
                                <th>Nama Paket </th>
                                <th>Status </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pakets as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> <img src="{{ asset($item->image) }}" style="width: 70px; height:40px;">
                                    </td>
                                    <td>{{ $item->nama_paket }}</td>
                            
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">InActive</span>
                                        @endif
                                    </td>

                                    <td>


                                        <a href="{{ route('edit.paket', $item->id) }}" class="btn btn-info"
                                            title="Edit Data"> <i class="fa fa-pencil"></i> </a>

                                        <a href="{{ route('delete.paket', $item->id) }}" class="btn btn-danger"
                                            id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>

                                        <a href="{{ route('edit.paket', $item->id) }}" class="btn btn-warning"
                                            title="Details Page"> <i class="fa fa-eye"></i> </a>

                                        @if ($item->status == 1)
                                            <a href="{{ route('paket.inactive', $item->id) }}" class="btn btn-primary"
                                                title="Inactive"> <i class="fa-solid fa-thumbs-down"></i> </a>
                                        @else
                                            <a href="{{ route('paket.active', $item->id) }}" class="btn btn-primary"
                                                title="Active"> <i class="fa-solid fa-thumbs-up"></i> </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Image </th>
                                <th>Nama Paket </th>
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
