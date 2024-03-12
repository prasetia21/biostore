@extends('frontend.guest_dashboard')
@section('main')
@section('title')
    Checkout Page
@endsection



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/guest/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Checkout
        </div>
    </div>
</div>
<div class="container mb-50 mt-20">
    <div class="row">
        <div class="col-lg-8 mb-20">
            <h3 class="heading-2 mb-10">Checkout</h3>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">Produk di dalam Keranjang Belanjamu</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 p-20">

            <div class="row">
                <h4 class="mb-30">Detail Pembayaran</h4>
                <form id="frmNinjaOrder" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="bg-billing">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="shipping_name" class="form-label">Nama Lengkap</label>
                                <input type="text" required="" name="shipping_name">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="shipping_email" class="form-label">Email</label>
                                <input type="email" required="" name="shipping_email">
                            </div>
                        </div>

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-12">
                                <label for="shipping_address" class="form-label">Alamat Lengkap</label>
                                <input required="" type="text" name="shipping_address"
                                    placeholder="Alamat Lengkap">
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="shipping_phone" class="form-label">No HP / WA</label>
                                <input required="" type="text" name="shipping_phone">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="post_code" class="form-label">Kode Pos</label>
                                <input required="" type="text" name="post_code" placeholder="Kode Pos *">
                            </div>
                            <div class="invisible">
                                <input required="" type="text" name="from_l1_tier_code" id="fromL1TierCode"
                                    value="ID_A00034_01" readonly hidden>
                                <input required="" type="text" name="from_l2_tier_code" id="fromL2TierCode"
                                    value="ID_B00512_01" readonly hidden>

                                <select class="form-control provinsi-asal" name="province_origin" hidden>
                                    <option value="DI Yogyakarta">DI Yogyakarta</option>
                                </select>
                                <select class="form-control kota-asal" name="city_origin" hidden>
                                    <option value="Yogyakarta">Yogyakarta</option>
                                </select>
                            </div>
                            <div class="w-100">
                                <div class="form-group col-lg-12">
                                    <label for="provinsi" class="form-label">Pilih Provinsi</label><br />
                                    <select class="form-control provinsi-tujuan" name="province_destination"
                                        id="provinsi" required>
                                        <option value="0">-- pilih provinsi --</option>
                                        @foreach ($provinces as $province => $value)
                                            <option value="{{ $province ?? '' }}">{{ $value ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-12 mt-40">
                                    <label for="kota" class="form-label">Pilih Kota / Kabupaten</label><br />
                                    <select class="form-control kota-tujuan" name="city_destination" id="kota"
                                        required>
                                        <option>Pilih Kota / Kabupaten...</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-12 mt-40">
                                    <label for="kecamatan" class="form-label">Pilih Kecamatan</label><br />
                                    <select class="form-control kecamatan-tujuan" name="kecamatan_destination"
                                        id="kecamatan" required>
                                        <option>Pilih Kecamatan...</option>
                                    </select>
                                </div>

                                <input required="" type="text" name="to_kecamatan_kirim" id="to_kecamatan_kirim"
                                    readonly hidden>
                                <input required="" type="text" name="to_kota_kirim" id="to_kota_kirim" readonly
                                    hidden>
                                <input required="" type="text" name="to_provinsi_kirim" id="to_provinsi_kirim"
                                    readonly hidden>


                                <input required="" type="text" name="to_l1_tier_code" id="toL1TierCode"
                                    readonly hidden>
                                <input required="" type="text" name="to_l2_tier_code" id="toL2TierCode"
                                    readonly hidden>

                            </div>
                            {{-- <div class="form-group col-lg-6 invisible">
                            <label for="kota" class="form-label">Pilih Kecamatan</label>

                            <select class="form-control" name="kecamatan" id="kecamatan" required>
                                <option>Pilih Kecamatan...</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 invisible">
                            <label for="kota" class="form-label">Pilih Kelurahan / Desa</label>

                            <select class="form-control" name="desa" id="desa" required>
                                <option>Pilih Desa / Kelurahan...</option>
                            </select>
                        </div> --}}
                        </div>
                        <br /><br />

                        <div class="row shipping_calculator">

                            <div class="form-group mb-20">
                                <textarea rows="5" placeholder="Catatan" name="notes"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="border p-20 cart-totals mb-20 mt-20">
                            <div class="d-flex align-items-end justify-content-between mb-30">
                                <h4>Order Produkmu</h4>

                            </div>
                            <div class="divider-2 mb-20"></div>
                            <div class="table-responsive order_table checkout">
                                <table class="table no-border">

                                    <tbody>
                                        @foreach ($carts as $item)
                                            <tr>
                                                <td class="image product-thumbnail"><img
                                                        src="{{ asset($item->options->image) }} " alt="#"
                                                        style="width:100px; height: 100px;"></td>
                                                <td>
                                                    <h6 class="w-160 mb-1"><a href="#"
                                                            class="text-heading">{{ $item->name }}</a></h6></span>
                                                    <div class="product-rate-cover">

                                                        {{-- <strong>Color :{{ $item->options->color }} </strong>
                                            <strong>Size : {{ $item->options->size }}</strong></br> --}}
                                                        <strong>Berat :
                                                            {{ $beratPaking1 = ($item->weight * $item->qty) / 1000 }}
                                                            Kilogram</strong></br>

                                                        <strong>Berat Packing:
                                                            {{ $beratPaking2 = ceil($beratPaking1 + ($item->options->width * $item->options->length * $item->options->height) / 6000) }}
                                                            Kilogram</strong>

                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                                </td>
                                                <td>
                                                    <h4 class="text-brand">Rp.{{ $item->price }}</h4>
                                                </td>
                                            </tr>
                                        @endforeach



                                    </tbody>
                                </table>



                                <table class="table no-border">
                                    <tbody>
                                        <tr>
                                            {{-- <td class="cart_total_label">
                                                <h6 class="text-muted">Pilihan Ekspedisi </h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end">
                                                    <div class="form-group">

                                                        <select class="form-control kurir" name="courier"
                                                            id="check-ongkir">
                                                            <option value="0">-- pilih kurir --</option>
                                                            <option value="jne">JNE</option>
                                                            <option value="pos">POS</option>
                                                            <option value="tiki">TIKI</option>
                                                        </select>
                                                    </div>
                                                </h4>
                                            </td> --}}

                                            {{-- <td class="cart_total_label">
                                                <h6 class="text-muted">Pilihan Service Kirim </h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end">
                                                    <div class="form-group">

                                                        <select class="form-control service" name="service_level"
                                                            id="check-service">
                                                            <option value="0">-- pilih servis --</option>
                                                            <option value="Standard">Standard</option>
                                                            <option value="Express">Express</option>
                                                            <option value="Sameday">Sameday</option>
                                                            <option value="Nextday">Nextday</option>
                                                        </select>
                                                    </div>
                                                </h4>
                                            </td> --}}

                                            @if (ceil($beratPaking1) > ceil($beratPaking2))
                                                <div class="form-group">
                                                    <label class="font-weight-bold">BERAT (Kilogram)</label>
                                                    <input type="number" class="form-control" name="weight"
                                                        id="weight" value="{{ $beratPaking1 }}" readonly>

                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label class="font-weight-bold">BERAT (Kilogram)</label>
                                                    <input type="number" class="form-control" name="weight"
                                                        id="weight" value="{{ $beratPaking2 }}" readonly>

                                                </div>
                                            @endif



                                        </tr>
                                    </tbody>
                                </table>


                                @php
                                    $requested_tracking_number = 'BT-' . mt_rand(100000, 999999);
                                    $merchant_order_number = 'BIOFAST-' . mt_rand(10000000, 99999999);

                                    $confirmed_date = \Carbon\Carbon::now();

                                    $formatdate = 'Y-m-d';

                                    $pickup_date = app(
                                        'App\Http\Controllers\Guest\User\CheckoutGuestController',
                                    )->getHariPickup();
                                    $delivery_start_date = \Carbon\Carbon::parse($pickup_date)
                                        ->addDay()
                                        ->format($formatdate);

                                    $quantity = Cart::content()->count();

                                    $token = App\Models\TokenNinja::firstOrFail();

                                    $token = $token->access_token;

                                @endphp

                                <input id="ship_price" type="text" value="" name="shipping_price" readonly
                                    hidden>

                                <input type="text" value="{{ $confirmed_date }}" name="confirmed_date" readonly
                                    hidden>

                                <input type="text" value="{{ $requested_tracking_number }}"
                                    name="requested_tracking_number" readonly hidden>
                                <input type="text" value="{{ $merchant_order_number }}"
                                    name="merchant_order_number" readonly hidden>
                                <input type="text" value="Bio Official" name="origin_name" readonly hidden>
                                <input type="text" value="082243380001" name="origin_phone" readonly hidden>
                                <input type="text" value="bioofficial@ninjasandbox.co" name="origin_email"
                                    readonly hidden>
                                <input type="text"
                                    value="JL. BABARAN BARAT GG. VIII UH III 817, Jl. Celeban, BARU, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta"
                                    name="shipping_origin1" readonly hidden>
                                <input type="text" value="" name="shipping_origin2" readonly hidden>
                                <input type="text" value="Umbulharjo" name="kecamatan_origin" readonly hidden>
                                <input type="text" value="Kota Yogyakarta" name="city_origin" readonly hidden>
                                <input type="text" value="DI Yogyakarta" name="province_origin" readonly hidden>
                                <input type="text" value="office" name="address_type_origin" readonly hidden>
                                <input type="number" value="55167" name="post_code_origin" readonly hidden>
                                <input type="text" value="{{ $pickup_date }}" name="pickup_date" readonly
                                    hidden>
                                <input type="text" value="{{ $delivery_start_date }}" name="delivery_start_date"
                                    readonly hidden>
                                <input type="number" value="{{ $quantity }}" name="quantity" readonly hidden>

                                <input type="text" value="{{ $token }}" name="tokenninja" readonly hidden>



                                <table class="table no-border">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">


                                            </td>

                                            <td class="cart_total_amount">
                                                <div id="loading-ongkir" class="text-center">

                                                </div>
                                                <ul class="list-group" id="ongkir"></ul>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>


                                <table class="table no-border">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Ongkos Kirim </h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end" id="result-ongkir" hidden></h4>
                                                <h4 class="text-brand text-end" id="result-ongkir-show"></h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <table class="table no-border">
                                    <tbody>

                                        @if (Session::has('coupon'))
                                            <tr hidden>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Sub Total + PPN</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end" id="result-subtotal">Rp.
                                                        {{ $cartTotal }}

                                                    </h4>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Coupon Name</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h6 class="text-brand text-end">
                                                        {{ session()->get('coupon')['coupon_name'] }}
                                                        (
                                                        {{ session()->get('coupon')['coupon_discount'] }}% ) </h6>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Coupon Discount</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end">
                                                        @price(session()->get('coupon')['discount_amount'])</h4>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Sub Total</h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end">
                                                        @price(session()->get('coupon')['total_amount'])</h4>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="cart_total_label">
                                                    <h6 class="text-muted">Sub Total + PPN </h6>
                                                </td>
                                                <td class="cart_total_amount">
                                                    <h4 class="text-brand text-end" id="result-subtotal">Rp.
                                                        {{ $cartTotal }}
                                                    </h4>
                                                </td>
                                            </tr>
                                        @endif



                                    </tbody>
                                </table>

                                <table class="table no-border">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Grand Total </h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end" id="result-grandtotal"></h4>
                                                <input id="grand_total" type="text" value=""
                                                    name="grand_total_price" readonly hidden>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="card shadow mb-20">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
                            </div>
                            <div class="card-body">

                                <div class="payment_option">
                                    {{-- <div class="custome-radio">

                                        <input class="form-check-input" required="" type="radio"
                                            name="payment_option" value="midtrans" id="exampleRadios3"
                                            checked="">

                                        <label class="form-check-label" for="exampleRadios3"
                                            data-bs-toggle="collapse" data-target="#bankTranfer"
                                            aria-controls="bankTranfer">Midtrans</label>
                                    </div> --}}
                                    <div class="custome-radio">

                                        <input class="form-check-input" required="" type="radio"
                                            name="payment_option" value="cod" id="exampleRadios4" checked="">

                                        <label class="form-check-label" for="exampleRadios4"
                                            data-bs-toggle="collapse" data-target="#checkPayment"
                                            aria-controls="checkPayment">Cash on delivery
                                            (COD)</label>
                                    </div>
                                </div>
                                <div class="payment-logo d-flex">
                                    <img class="mr-15"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}"
                                        alt="">
                                    <img class="mr-15"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}"
                                        alt="">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-fill-out btn-block mt-30">Order<i
                                            class="fi-rs-sign-out ml-15"></i></button>
                                    <div id="msg"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //active select2
        $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
            theme: 'bootstrap4',
            width: 'style',
        });
        //ajax select kota asal
        $('select[name="province_origin"]').on('change', function() {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/ninjacity/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('select[name="city_origin"]').empty();
                        $('select[name="city_origin"]').append(
                            '<option value="">-- pilih kota asal --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="city_origin"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_origin"]').append(
                    '<option value="">-- pilih kota asal --</option>');
            }
        });
        //ajax select kota tujuan
        $('select[name="province_destination"]').on('change', function() {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/ninjacity/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append(
                            '<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="city_destination"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').append(
                    '<option value="">-- pilih kota tujuan --</option>');
            }
        });


        $('select[name="city_destination"]').on('change', function() {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/ninjadistricts/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('select[name="kecamatan_destination"]').empty();
                        $('select[name="kecamatan_destination"]').append(
                            '<option value="">-- pilih kecamatan tujuan --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="kecamatan_destination"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="kecamatan_destination"]').append(
                    '<option value="">-- pilih kecamatan tujuan --</option>');
            }
        });

        $('select[name="kecamatan_destination"]').on('change', function() {
            $('input[name="to_kecamatan_kirim"]').val($('#kecamatan :selected').text());
            $('input[name="to_kota_kirim"]').val($('#kota :selected').text());
            $('input[name="to_provinsi_kirim"]').val($('#provinsi :selected').text());

            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/ninjacode/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('input[name="to_l1_tier_code"]').empty();
                        $('input[name="to_l2_tier_code"]').empty();


                        $('input[name="to_l1_tier_code"]').val(response.l1_tier_code);
                        $('input[name="to_l2_tier_code"]').val(response.l2_tier_code);



                        ninjaOngkir();

                    },
                });
            } else {
                $('input[name="to_l1_tier_code"]').empty();
                $('input[name="to_l2_tier_code"]').empty();
            }
        });

        function ninjaOngkir() {
            //ajax check ongkir
            let isProcessing = false;
            $('#loading-ongkir').html(
                '<img src="{{ asset('frontend/assets/imgs/theme/ongkir-loading.gif') }}" alt="loading ongkir" /><h6>Mohon Menunggu...</h6>'
            );
            $('#ongkir').empty();

            let token = $("meta[name='csrf-token']").attr("content");
            let weight = $('#weight').val();
            let service_level = "Standard";
            let l1_tier_code = $('#fromL1TierCode').val();
            let l2_tier_code = $('#fromL2TierCode').val();
            let tol1_tier_code = $('#toL1TierCode').val();
            let tol2_tier_code = $('#toL2TierCode').val();


            if (isProcessing) {
                return;
            }

            isProcessing = true;
            $.ajax({
                url: "/api/ninja-tarif",
                data: {
                    _token: token,
                    weight: weight,
                    service_level: service_level,
                    l1_tier_code: l1_tier_code,
                    l2_tier_code: l2_tier_code,
                    tol1_tier_code: tol1_tier_code,
                    tol2_tier_code: tol2_tier_code,
                },
                dataType: "JSON",
                type: "POST",
                success: function(response) {
                    $('#loading-ongkir').html('');
                    isProcessing = false;
                    if (response) {
                        let fee = Object.values(response.data);
                        let total_fee = fee[0].total_fee;


                        $("#result-ongkir").html(total_fee);
                        $("#result-ongkir-show").html("Rp. " + total_fee);

                        let harga = document.getElementById("result-ongkir").innerHTML;
                        let hargaSub = document.getElementById("result-subtotal").innerHTML;

                        const intHarga = harga.split(" ");
                        const intSubHarga = hargaSub.split(" ");

                        const hargaOngkir = parseInt(intHarga[0]);
                        const hargaSubTotal = parseInt(intSubHarga[56].substring().replace(
                            /[\.,]0{2}/, '').replaceAll(',', ''));
                        const totalHarga = hargaOngkir + hargaSubTotal;

                        const strOngkirTotal = hargaOngkir.toString().replace(
                            /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                        const strGrandTotal = totalHarga.toString().replace(
                            /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                        const strGrandTotal2 = totalHarga.toString().replace(
                            /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, "");

                        document.getElementById("result-ongkir-show").innerHTML = "Rp. " +
                            strOngkirTotal + ".00";
                        document.getElementById("ship_price").value = hargaOngkir;
                        document.getElementById("result-grandtotal").innerHTML = "Rp. " +
                            strGrandTotal + ".00";
                        document.getElementById("grand_total").value = parseInt(strGrandTotal2);

                    }
                }
            });

        }

    });
</script>
<script>
    function displayRadioValue() {
        let ele = document.getElementsByName('ongkir-price');

        for (i = 0; i < ele.length; i++) {
            if (ele[i].checked)
                document.getElementById("result-ongkir").innerHTML = "Rp. " + ele[i].nextSibling.data + ele[i].value;
        }


        let harga = document.getElementById("result-ongkir").innerHTML;
        let hargaSub = document.getElementById("result-subtotal").innerHTML;

        const intHarga = harga.split(" ");
        const intSubHarga = hargaSub.split(" ");

        let servisExpedisi = intHarga[1];
        document.getElementById("ship_expedition").value = servisExpedisi;

        if (intHarga[1] === "POS") {
            let servisEst = intHarga[6];
            let servisExpLayanan = intHarga[4] + ' ' + intHarga[5];
            document.getElementById("ship_service").value = servisExpLayanan;
            document.getElementById("ship_estimation").value = servisEst;
        } else {
            let servisEst = intHarga[5];
            let servisExpLayanan = intHarga[1] + ' ' + intHarga[4];
            document.getElementById("ship_service").value = servisExpLayanan;
            document.getElementById("ship_estimation").value = servisEst;
        }

        const hargaOngkir = parseInt(intHarga[3]);
        const hargaSubTotal = parseInt(intSubHarga[56].substring().replace(/[\.,]0{2}/, '').replaceAll(',', ''));
        const totalHarga = hargaOngkir + hargaSubTotal;
        const strGrandTotal = totalHarga.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        const strGrandTotal2 = totalHarga.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, "");

        document.getElementById("result-ongkir-show").innerHTML = "Rp. " + hargaOngkir;
        document.getElementById("ship_price").value = hargaOngkir;
        document.getElementById("result-grandtotal").innerHTML = "Rp. " + strGrandTotal;
        document.getElementById("grand_total").value = parseInt(strGrandTotal2);

    }
</script>

<script>


    $('#frmNinjaOrder').on('submit', function(e) {
        e.preventDefault();
        console.log('payload:', token);

        $('#btnSubmited').hide('fast');
        $('#msg').html('Please wait...');
        $('#btnSubmited').prop('disabled', true);

    // Get form data using jQuery
    const requested_tracking_number = $("input[name='requested_tracking_number']").val();
    const merchant_order_number = $("input[name='merchant_order_number']").val();
    const origin_name = $("input[name='origin_name']").val();
    const origin_phone = $("input[name='origin_phone']").val();
    const origin_email = $("input[name='origin_email']").val();
    const shipping_origin1 = $("input[name='shipping_origin1']").val();
    const shipping_origin2 = $("input[name='shipping_origin2']").val();
    const kecamatan_origin = $("input[name='kecamatan_origin']").val();
    const city_origin = $("input[name='city_origin']").val();
    const province_origin = $("input[name='province_origin']").val();
    const address_type_origin = $("input[name='address_type_origin']").val();
    const country_origin = "ID"
    const post_code_origin = $("input[name='post_code_origin']").val();
    const shipping_name = $("input[name='shipping_name']").val();
    const shipping_phone = $("input[name='shipping_phone']").val();
    const shipping_email = $("input[name='shipping_email']").val();
    const shipping_address1 = $("input[name='shipping_address1']").val();
    const shipping_address2 = $("input[name='shipping_address2']").val();
    const kecamatan_destination = $("input[name='to_kecamatan_kirim']").val();
    const city_destination = $("input[name='to_kota_kirim']").val();
    const province_destination = $("input[name='to_provinsi_kirim']").val();
    const address_type_destination = "home"
    const country_destination = "ID"
    const post_code_destination = $("input[name='post_code']").val();
    const cash_on_delivery = $("input[name='grand_total_price']").val();
    const currency = "IDR"
    const pickup_date = $("input[name='pickup_date']").val();
    const delivery_start_date = $("input[name='delivery_start_date']").val();
    const weight = $('#weight').val();
    const item_description = "Cat Kayu Biovarnish";
    const quantity = $("input[name='quantity']").val();
    const token = $("input[name='tokenninja']").val();

        // Prepare request data
        const data = {
            service_type: "Parcel",
            service_level: "Standard",
            requested_tracking_number: requested_tracking_number,
            reference: {
                merchant_order_number: merchant_order_number
            },
            from: {
                name: origin_name,
                phone_number: origin_phone,
                email: origin_email,
                address: {
                    address1: shipping_origin1,
                    address2: shipping_origin2,
                    kecamatan: kecamatan_origin,
                    city: city_origin,
                    province: province_origin,
                    address_type: address_type_origin,
                    country: country_origin,
                    postcode: post_code_origin
                }
            },
            to: {
                name: shipping_name,
                phone_number: shipping_phone,
                email: shipping_email,
                address: {
                    address1: shipping_address1,
                    address2: shipping_address2,
                    kecamatan: kecamatan_destination,
                    city: city_destination,
                    province: province_destination,
                    address_type: address_type_destination,
                    country: country_destination,
                    postcode: post_code_destination
                }
            },
            parcel_job: {
                is_pickup_required: true,
                pickup_address_id: "",
                pickup_service_type: "Scheduled",
                pickup_service_level: "Standard",
                cash_on_delivery: cash_on_delivery,
                cash_on_delivery_currency: currency,
                pickup_date: pickup_date,
                pickup_timeslot: {
                    start_time: "09:00",
                    end_time: "11:00",
                    timezone: "Asia / Jakarta"
                },
                pickup_instructions: "Pickup with care!",
                delivery_instructions: "COD(Cash on Delivery)",
                delivery_start_date: delivery_start_date,
                delivery_timeslot: {
                    start_time: "09:00",
                    end_time: "11:00",
                    timezone: "Asia / Jakarta"
                },
                dimensions: {
                    weight: weight
                },
                items: [{
                    item_description: item_description,
                    quantity: quantity,
                    is_dangerous_good: false
                }]
            }
        };

        console.log('payload:', data);
        // Send POST request using jQuery's AJAX method
        $.ajax({
            url: 'https://api-sandbox.ninjavan.co/sg/4.2/orders',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            async: true,
            headers: {
                'Access-Control-Allow-Origin': 'https://api-sandbox.ninjavan.co/sg/4.2/orders',
                Authorization: 'Bearer ' + token
            },
            success: function(responseData) {
                resend();
                console.log('Response:', responseData);
                // Display success message or handle data as needed
            },
            error: function(error) {
                console.error('Error:', error);
                console.log('Response:', data);
                // Display error message to the user
            }
        });

    });

    function resend() {
        $.ajax({
            url: '/cod/ninja',
            type: 'post',

            data: $('#frmNinjaOrder').serialize(),
            success: function(result) {

                $('#frmNinjaOrder')[0].reset();

                // window.location.href = '/';
            }

        });

    }
</script>

@endsection
