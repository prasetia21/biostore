@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Lihat Gudang</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Lihat Gudang</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.gudang') }}" class="btn btn-primary">Tambah Gudang</a>
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
                                <th>Label </th>
                                <th>Nama PIC </th>
                                <th>Provinsi </th>
                                <th>Kota </th>
                                <th>Kecamatan </th>
                                <th>Kode Pos </th>
                                <th>Nomor Telpon </th>
                                <th>Nomor Telpon Cadangan </th>
                                <th>Alamat </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gudangs as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->label }}</td>
                                    <td>{{ $item->pic_name }}</td>
                                    <td>{{ $item->province->name }}</td>
                                    <td>{{ $item->city->name }}</td>
                                    <td>{{ $item->district->name }}</td>
                                    <td>{{ $item->post_code }}</td>
                                    <td>{{ $item->phone_1 }}</td>
                                    <td>{{ $item->phone_2 }}</td>
                                    <td>{{ $item->address }}</td>

                                    
                                    <td>

                                            <a href="{{ route('edit.gudang', $item->id) }}" class="btn btn-info">Edit</a>
                               

                                            <a href="{{ route('delete.gudang', $item->id) }}" class="btn btn-danger"
                                                id="delete">Delete</a>
                               
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Label </th>
                                <th>Nama PIC </th>
                                <th>Provinsi </th>
                                <th>Kota </th>
                                <th>Kecamatan </th>
                                <th>Kode Pos </th>
                                <th>Nomor Telpon </th>
                                <th>Nomor Telpon Cadangan </th>
                                <th>Alamat </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
