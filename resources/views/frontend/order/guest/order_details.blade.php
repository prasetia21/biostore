
@php

    $order = App\Models\OrderNinja::where('guest_id', $guestData->id)->get();

    $orderItem = App\Models\OrderItem::with('product')->where('order_ninja_id', $order[0]->id)->orderBy('order_ninja_id', 'DESC')->get();
    
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
                                                        <th>{{ $order[0]->shipping_name }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>No Telepon:</th>
                                                        <th>{{ $order[0]->shipping_phone }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Email:</th>
                                                        <th>{{ $order[0]->shipping_email }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Alamat Pengiriman:</th>
                                                        <th>{{ $order[0]->shipping_address1 }}, {{ $order[0]->province_destination }}, {{ $order[0]->city_destination }}, Kodepos: {{ $order[0]->post_code_destination }}</th>
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
                                                    <span class="text-danger">Invoice : {{ $order[0]->requested_tracking_number }} </span>
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

                                                        <th>{{ $order[0]->shipping_service }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Berat Paket:</th>
                                                        <th>{{ $order[0]->weight }} gram</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Ongkos Kirim:</th>
                                                        <th>@price($order[0]->shipping_price)</th>
                                                    </tr>

                                                    {{-- <tr>
                                                        <th>Estimasi Terkirim:</th>
                                                        <th>{{ $order[0]->shipping_estimation }} Hari</th>
                                                    </tr> --}}


                                                    <tr>
                                                        <th>Ninja Tracking ID:</th>
                                                        <th>{{ $order[0]->tracking_number }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th>Invoice:</th>
                                                        <th class="text-danger">{{ $order[0]->requested_tracking_number }}</th>
                                                    </tr>

                                                    <tr>
                                                        <th></th>
                                                        <th class="text-danger"><a href="{{ url('guest/invoice_download/' . $order[0]->id) }}" class="badge rounded-pill bg-success">Download Invoice</a></th>
                                                    </tr>

                                                    <tr>
                                                        <th>Total Harga Pesanan:</th>
                                                        <th>@price($order[0]->amount)</th>
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
