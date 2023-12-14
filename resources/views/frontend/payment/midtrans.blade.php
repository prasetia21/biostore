@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Midtrans Payment
@endsection

<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .MidtransElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .MidtransElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .MidtransElement--invalid {
        border-color: #fa755a;
    }

    .MidtransElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

<script>
    window.onload = function() {
        document.getElementById('midtransPay').click();
    }
</script>

<!-- Preloader Start -->

<div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-inner position-relative">
        <div class="text-center">
            <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
            <h6>Mohon Tunggu Sebentar Anda Akan Diarahkan ke Halaman Pembayaran</h6>
        </div>
    </div>
</div>


<div class="bv-payment-23122">

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Midtrans Payment
            </div>
        </div>
    </div>
    <div class="container mb-20 mt-20">
        <div class="row">
            <div class="col-lg-12 mb-20">
                <h3 class="heading-2 mb-10">Midtrans Payment</h3>
                <div class="d-flex justify-content-between">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">


                <div class="border p-20 cart-totals mb-20">
                    <div class="d-flex align-items-end justify-content-between mb-20">
                        <h4>Detail Order</h4>

                    </div>
                    <div class="divider-2 mb-20"></div>
                    <div class="table-responsive order_table checkout">

                        <table class="table no-border">
                            <tbody>

                                @if (Session::has('coupon'))
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">Rp.{{ $data['total'] }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupn Name</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h6 class="text-brand text-end">
                                                {{ session()->get('coupon')['coupon_name'] }} (
                                                {{ session()->get('coupon')['coupon_discount'] }}% )</h6>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon Discount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                Rp.{{ session()->get('coupon')['discount_amount'] }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                Rp.{{ session()->get('coupon')['total_amount'] }}</h4>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">Rp.{{ $data['total'] }}</h4>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!-- // end lg md 6 -->


            <div class="col-lg-12">
                <div class="border p-20 cart-totals mb-20">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Pembayaran </h4>

                    </div>
                    <div class="divider-2 mb-20"></div>
                    <div class="table-responsive order_table checkout">


                        <form action="{{ route('midtrans.order') }}" method="post" id="payment-form">
                            @csrf
                            <div class="form-row">
                                <label for="card-element">
                                    Transfer, Kartu Kredit atau Kartu Debit


                                    <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                    <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                    <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                    <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                    <input type="hidden" name="province" value="{{ $data['province_destination'] }}">
                                    <input type="hidden" name="city" value="{{ $data['city_destination'] }}">
                                    <input type="hidden" name="address" value="{{ $data['shipping_address'] }}">
                                    <input type="hidden" name="notes" value="{{ $data['notes'] }}">

                                    <input type="hidden" name="weight" value="{{ $data['weight'] }}">
                                    <input type="hidden" name="shipping_price" value="{{ $data['shipping_price'] }}">
                                    <input type="hidden" name="shipping_expedition"
                                        value="{{ $data['shipping_expedition'] }}">
                                    <input type="hidden" name="shipping_service"
                                        value="{{ $data['shipping_service'] }}">
                                    <input type="hidden" name="shipping_estimation"
                                        value="{{ $data['shipping_estimation'] }}">

                                    <input type="hidden" name="total" value="{{ $data['total'] }}">


                                </label>

                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <br>
                            <div class="d-grid gap-2">
                                <button id="midtransPay" class="btn btn-primary">Lanjut ke Pembayaran</button>
                            </div>
                        </form>


                    </div>
                </div>



            </div>
        </div>
    </div>

</div>


<script>
    window.onload = function() {
        document.getElementById('midtransPay').click();
    }
</script>




@endsection
