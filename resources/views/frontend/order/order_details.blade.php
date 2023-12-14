@extends('dashboard')
@section('user')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>
    <section id="profile-page-sec">

        <div class="page-content pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Detail Pengiriman</h4>
                                            </div>
                                            <hr>
                                            <div class="card-body">
                                                <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                    <tr>
                                                        <th>Nama Penerima:</th>
                                                        <th>{{ $order->name }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>No Telepon:</th>
                                                        <th>{{ $order->phone }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Email:</th>
                                                        <th>{{ $order->email }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Alamat Pengiriman:</th>
                                                        <th>{{ $order->address }}</th>
                                                    </tr>


                                                    <tr>
                                                        <th>Provinsi:</th>
                                                        <th>{{ $addressProvince->name }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Kota:</th>
                                                        <th>{{ $addressCity->name }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Kode Pos :</th>
                                                        <th>{{ $order->post_code }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Tanggal Order :</th>
                                                        <th>{{ $order->order_date }}</th>
                                                    </tr>

                                                </table>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Detail Pesanan
                                                    <span class="text-danger">Invoice : {{ $order->invoice_no }} </span>
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
                                                        <th>No Telepon :</th>
                                                        <th>{{ $order->user->phone }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Metode Pembayaran:</th>
                                                        <th>{{ $order->payment_method }}</th>
                                                    </tr>

                                                    
                                                    
                                                    
                                                    <tr>
                                                        <th>Ekspedisi:</th>
                                                        
                                                        <th>{{$orderShip[0]->shipping_service}}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Berat Paket:</th>
                                                        <th>{{$orderShip[0]->weight}} gram</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Ongkos Kirim:</th>
                                                        <th>@price($orderShip[0]->shipping_price)</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Estimasi Terkirim:</th>
                                                        <th>{{ $orderShip[0]->shipping_estimation }} Hari</th>
                                                    </tr>


                                                    <tr>
                                                        <th>ID Transaksi:</th>
                                                        <th>{{ $order->transaction_id }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Invoice:</th>
                                                        <th class="text-danger">{{ $order->invoice_no }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Total Harga Pesanan:</th>
                                                        <th>Rp.{{ $order->amount }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Status Pemesanan:</th>
                                                        <th><span
                                                                class="badge rounded-pill bg-warning">{{ $order->status }}</span>
                                                        </th>
                                                    </tr>

                                                </table>

                                            </div>

                                        </div>
                                    </div>

                                </div><!-- // End Row  -->




                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" style="font-weight: 600;">
                            <tbody>
                                <tr>
                                    <td class="col-md-1">
                                        <label>Photo </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Nama Produk </label>
                                    </td>
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

                <!--  // Start Return Order Option  -->

                @if ($order->status !== 'deliverd')
                @else
                    @php
                        $order = App\Models\Order::where('id', $order->id)
                            ->where('return_reason', '=', null)
                            ->first();
                    @endphp

                    @if ($order)
                        <form action="{{ route('return.order', $order->id) }}" method="post">
                            @csrf

                            <div class="form-group" style=" font-weight: 600; font-size: initial; color: #000000; ">
                                <label>Order Return Reason</label>
                                <textarea name="return_reason" class="form-control" style="width:40%;"></textarea>
                            </div>
                            <button type="submit" class="btn-sm btn-danger" style="width:40%;">Order Return</button>
                        </form>
                    @else
                        <h5><span class=" " style="color:red;">You have send return request for this product</span>
                        </h5>
                        <br><br>
                    @endif
                @endif
                <!--  // End Return Order Option  -->

            </div>
        </div>

        @include('frontend.body.dashboard_navigation_menu')
    </section>
@endsection
