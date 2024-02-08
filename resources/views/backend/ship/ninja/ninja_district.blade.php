@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Daftar Kode Pengiriman Ninja</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List Wilayah Indonesia<span
                                class="badge rounded-pill bg-danger"> {{ count($ninja) }} </span> </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('district.ninja') }}" class="btn btn-primary">Import Data</a>
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
                                <th>ID Regency </th>
                                <th>Kabupaten / Kota </th>
                                <th>L1 Tier Code </th>
                                <th>L2 Tier Code </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ninja as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $item->ninja_regency_id }}</td>
                                    <td> {{ $item->name }}</td>
                                    <td> {{ $item->l1_tier_code }}</td>
                                    <td> {{ $item->l2_tier_code }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>ID Regency </th>
                                <th>Kabupaten / Kota </th>
                                <th>L1 Tier Code </th>
                                <th>L2 Tier Code </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
