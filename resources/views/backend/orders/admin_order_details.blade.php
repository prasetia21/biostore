@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin Order Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Admin Order Details</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <hr />


        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Pengiriman</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table" style="background:#F4F6FA;font-weight: 600;">
                            <tr>
                                <th>Nama Penerima:</th>
                                <th>{{ $order->shipping_name }}</th>
                            </tr>

                            <tr>
                                <th>No. HP/WA:</th>
                                <th>{{ $order->shipping_phone }}</th>
                            </tr>

                            <tr>
                                <th>Email:</th>
                                <th>{{ $order->shipping_email }}</th>
                            </tr>

                            <tr>
                                <th>Alamat Lengkap:</th>
                                <th>{{ $order->shipping_address1 }}</th>
                            </tr>


                            <tr>
                                <th>Provinsi:</th>
                                <th>{{ $order->province->name }}</th>
                            </tr>

                            <tr>
                                <th>Kota / Kabupaten:</th>
                                <th>{{ $order->city->name }}</th>
                            </tr>

                            <tr>
                                <th>Kode Post :</th>
                                <th>{{ $order->post_code_destination }}</th>
                            </tr>

                            <tr>
                                <th>Tanggal Order :</th>
                                <th>{{ $order->order_date }}</th>
                            </tr>

                        </table>

                    </div>

                </div>
            </div>


            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Order
                            <span class="text-danger">Invoice : {{ $order->requested_tracking_number }} </span>
                        </h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table" style="background:#F4F6FA;font-weight: 600;">
                            <tr>
                                <th> Nama :</th>
                                <th>{{ $order->user->name }}</th>
                            </tr>

                            <tr>
                                <th>No. HP/WA :</th>
                                <th>{{ $order->user->phone }}</th>
                            </tr>

                            <tr>
                                <th>Tipe Pembayaran:</th>
                                <th>{{ $order->payment_type }}</th>
                            </tr>


                            <tr>
                                <th>ID Transaksi:</th>
                                <th>{{ $order->merchant_order_number }}</th>
                            </tr>

                            <tr>
                                <th>Invoice:</th>
                                <th class="text-danger">{{ $order->requested_tracking_number }}</th>
                            </tr>

                            <tr>
                                <th>Total Harga:</th>
                                <th>Rp.{{ $order->amount }}</th>
                            </tr>

                            <tr>
                                <th>Status Order:</th>
                                <th><span class="badge bg-danger" style="font-size: 15px;">{{ $order->status }}</span></th>
                            </tr>


                            <tr>
                                <th> </th>
                                <th>
                                    @if ($order->status == 'pending')
                                        <a href="{{ route('pending-confirm', $order->id) }}"
                                            class="btn btn-block btn-success" id="confirm">Confirm Order</a>
                                    @elseif($order->status == 'confirm')
                                        <a href="{{ route('confirm-processing', $order->id) }}"
                                            class="btn btn-block btn-success" id="processing">Processing Order</a>
                                    @elseif($order->status == 'paid')
                                        <a href="{{ route('processing-delivered', $order->id) }}"
                                            class="btn btn-block btn-success" id="delivered">Delivered Order</a>
                                    @endif



                                </th>
                            </tr>

                        </table>

                    </div>

                </div>
            </div>
        </div>






        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
            <div class="col">
                <div class="card">


                    <div class="table-responsive">
                        <table class="table" style="font-weight: 600;">
                            <tbody>
                                <tr>
                                    <td class="col-md-1">
                                        <label>Image </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Nama Produk </label>
                                    </td>
                                    <!-- <td class="col-md-2">
                        <label>Vendor Name </label>
                    </td> -->
                                    <td class="col-md-2">
                                        <label>Kode Produk </label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Warna </label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Kemasan </label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Quantity </label>
                                    </td>

                                    <td class="col-md-3">
                                        <label>Harga </label>
                                    </td>

                                </tr>


                                @foreach ($orderItem as $item)
                                    <tr>
                                        <td class="col-md-1">
                                            <label><img src="{{ asset($item->product->product_thumbnail) }}"
                                                    style="width:50px; height:50px;"> </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>{{ $item->product->product_name }}</label>
                                        </td>
                                        <!-- @if ($item->vendor_id == null)
    <td class="col-md-2">
                        <label>Admin </label>
                    </td>
@else
    <td class="col-md-2">
                        <label>{{ $item->product->vendor->name }} </label>
                    </td>
    @endif -->

                                        <td class="col-md-2">
                                            <label>{{ $item->product->product_code }} </label>
                                        </td>
                                        @if ($item->color == null)
                                            <td class="col-md-1">
                                                <label>.... </label>
                                            </td>
                                        @else
                                            <td class="col-md-1">
                                                <label>{{ $item->color }} </label>
                                            </td>
                                        @endif

                                        @if ($item->size == null)
                                            <td class="col-md-1">
                                                <label>.... </label>
                                            </td>
                                        @else
                                            <td class="col-md-1">
                                                <label>{{ $item->size }} </label>
                                            </td>
                                        @endif
                                        <td class="col-md-1">
                                            <label>{{ $item->qty }} </label>
                                        </td>

                                        <td class="col-md-3">
                                            <label>Rp.{{ $item->price }} <br> Total = Rp.{{ $item->price * $item->qty }}
                                            </label>
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
@endsection
