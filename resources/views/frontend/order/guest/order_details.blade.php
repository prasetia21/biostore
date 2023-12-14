
@php

    $order = App\Models\Order::where('guest_id', $guestData->id)->get();
    
    $orderItem = App\Models\OrderItem::with('product')->where('order_id', $order[0]->id)->orderBy('id', 'DESC')->get();
    $orderShip = App\Models\OrderShipping::where('order_id', $order[0]->id)->orderBy('id', 'DESC')->get();
@endphp

{{-- @dd($order); --}}

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
                                                        <th>{{ $order[0]->name }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>No Telepon:</th>
                                                        <th>{{ $order[0]->phone }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Email:</th>
                                                        <th>{{ $order[0]->email }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Alamat Pengiriman:</th>
                                                        <th>{{ $order[0]->address }}, {{ $order[0]->province->name }}, {{ $order[0]->city->name }}, Kodepos: {{ $order[0]->post_code }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Tanggal Order :</th>
                                                        <th>{{ $order[0]->order_date }}</th>
                                                    </tr>

                                                </table>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Detail Pesanan
                                                    <span class="text-danger">Invoice : {{ $order[0]->invoice_no }} </span>
                                                </h4>
                                            </div>
                                            <hr>
                                            <div class="card-body">
                                                <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                    <tr>
                                                        <th>Metode Pembayaran:</th>
                                                        <th>{{ $order[0]->payment_method }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Ekspedisi:</th>

                                                        <th>{{ $orderShip[0]->shipping_service }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Berat Paket:</th>
                                                        <th>{{ $orderShip[0]->weight }} gram</th>
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
                                                        <th>{{ $order[0]->transaction_id }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Invoice:</th>
                                                        <th class="text-danger">{{ $order[0]->invoice_no }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th></th>
                                                        <th class="text-danger"><a href="{{ url('guest/invoice_download/' . $order[0]->id) }}" class="badge rounded-pill bg-success">Download Invoice</a></th>
                                                    </tr>

                                                    <tr>
                                                        <th>Total Harga Pesanan:</th>
                                                        <th>Rp.{{ $order[0]->amount }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Status Pemesanan:</th>
                                                        <th><span
                                                                class="badge rounded-pill bg-warning">{{ $order[0]->status }}</span>
                                                        </th>
                                                    </tr>

                                                </table>

                                                <div class="alert alert-danger" role="alert">
                                                    <h4 class="alert-heading">PERHATIAN!</h4>
                                                    <p>Harap Simpan Baik-baik Nomor Invoice, No. Invoice dapat Anda Gunakan untuk Melakukkan Tracking Pemesanan di Halaman Order Tracking</p>
                                                    <hr>
                                                    <p class="mb-0"><a href="{{ route('user.track.order.guest') }}">Klik disini</a> untuk menuju halaman Order Tracking</p>
                                                  </div>

                                                <h2></h2>

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

    </section>
@endsection
