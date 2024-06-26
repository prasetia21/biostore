@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Lihat Order Pending</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Lihat Order Pending</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">

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
                                <th>Tanggal </th>
                                <th>Invoice </th>
                                <th>Amount </th>
                                <th>Pembayaran </th>
                                <th>Status </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>{{ $item->requested_tracking_number }}</td>
                                    <td>Rp.{{ $item->amount }}</td>
                                    <td>{{ $item->payment_type }}</td>
                                    <td> <span class="badge rounded-pill bg-success"> {{ $item->status }}</span></td>

                                    <td>
                                        <a href="{{ route('admin.order.details', $item->id) }}" class="btn btn-info"
                                            title="Details"><i class="fa fa-eye"></i> </a>


                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal </th>
                                <th>Invoice </th>
                                <th>Amount </th>
                                <th>Pembayaran </th>
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
