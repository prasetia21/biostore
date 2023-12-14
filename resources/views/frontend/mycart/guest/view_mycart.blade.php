@extends('frontend.guest_dashboard')
@section('main')
@section('title')
    MyCart Page
@endsection

    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/guest/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Cart
        </div>
    </div>
</div>

<div class="container mb-50 mt-20">
    <div class="row">
        <div class="col-lg-8 mb-20">
            <h4 class="heading-2 mb-10">Keranjang Belanja</h4>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">Produk di dalam Keranjang Belanjamu</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive shopping-summery">
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                            </th>
                            <th scope="col">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="cartPage">

                    </tbody>
                </table>
            </div>

            <div class="row mt-20">
                <div class="col-lg-12">
                    @if (Session::has('coupon'))
                    @else
                        <div class="p-20" id="couponField">
                            <p class="mb-20"><span class="font-lg text-muted">Gunakan Kode Promo?</p>
                            <form action="#">
                                <div class="d-flex justify-content-between">
                                    <input class="font-medium mr-15 coupon" id="coupon_name"
                                        placeholder="Enter Your Coupon">
                                    <a type="submit" onclick="applyCoupon()" class="btn btn-success"><i
                                            class="fi-rs-label mr-10"></i>Apply</a>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="col-lg-12">
                    <div class="divider-2 mb-20"></div>
                    <div class="border p-md-4 cart-totals">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody id="couponCalField">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="checkout-buy-now-btn mt-24">
                    <a href="{{ route('checkout.guest') }}">Chekout</a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
