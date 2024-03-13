@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Checkout Page
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
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
                <form method="post" action="{{ route('user.ninja.order') }}">
                    @csrf

                    <div class="bg-billing">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="shipping_name" class="form-label">Nama Lengkap</label>
                                <input type="text" required="" name="shipping_name"
                                value="{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="shipping_email" class="form-label">Email</label>
                                <input type="email" required="" name="shipping_email"
                                value="{{ !empty(Auth::user()->email) ? Auth::user()->email : '' }}">
                                    
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="shipping_phone" class="form-label">No HP / WA</label>
                                <input required="" type="text" name="shipping_phone"
                                    value="{{ !empty($address->phone) ? $address->phone : '' }}">
                            </div>
                        </div>

                        <div class="row shipping_calculator invisible">
                            <div class="form-group col-lg-12" hidden>
                                <label for="shipping_address1" class="form-label">Alamat Lengkap</label>
                                <input required="" type="text" name="shipping_address1"
                                    placeholder="Alamat Lengkap" value="{{ !empty($address->address) ? $address->address : '' }}">
                            </div>
                            
                            <div class="form-group col-lg-4" hidden>
                                <label for="post_code" class="form-label">Kode Pos</label>
                                <input required="" type="text" name="post_code" placeholder="Kode Pos *" value="{{ !empty($address->post_code) ? $address->post_code : '' }}">
                            </div>
                            <div class="invisible">
                                <select class="form-control provinsi-asal" name="province_origin" hidden>
                                    <option value="0">DI Yogyakarta</option>
                                </select>
                                <select class="form-control kota-asal" name="city_origin" hidden>
                                    <option value="0">Yogyakarta</option>
                                </select>
                            </div>
                            <div class="w-100" hidden>
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


                                

                            </div>
                           
                        </div>
                        <br /><br />

                        <div class="row shipping_calculator note">

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
                                                    <h6 class="w-160 mb-1"><a href="shop-product-full.html"
                                                            class="text-heading">{{ $item->name }}</a></h6></span>
                                                    <div class="product-rate-cover">

                                                        {{-- <strong>Color :{{ $item->options->color }} </strong>
                                            <strong>Size : {{ $item->options->size }}</strong></br> --}}
                                                        <strong>Berat :
                                                            {{ $beratPaking1 = $item->weight * $item->qty }}
                                                            Gram</strong></br>

                                                        <strong>Berat Packing:
                                                            {{ $beratPaking2 = $item->weight * $item->qty + ceil(($item->options->width * $item->options->length * $item->options->height) / 6000) }}
                                                            Gram</strong>

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
                                            <td class="cart_total_label">
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
                                            </td>

                                            @if (ceil($beratPaking1) > ceil($beratPaking2))
                                                <div class="form-group">
                                                    <label class="font-weight-bold">BERAT (GRAM)</label>
                                                    <input type="number" class="form-control" name="weight"
                                                        id="weight" value="{{ $beratPaking1 }}" readonly>

                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label class="font-weight-bold">BERAT (GRAM)</label>
                                                    <input type="number" class="form-control" name="weight"
                                                        id="weight" value="{{ $beratPaking2 }}" readonly>

                                                </div>
                                            @endif



                                        </tr>
                                    </tbody>
                                </table>


                                <input id="ship_price" type="text" value="" name="shipping_price" hidden readonly>
                                <input id="ship_expedition" type="text" value="" name="shipping_expedition" hidden readonly>
                                <input id="ship_service" type="text" value="" name="shipping_service" hidden readonly>
                                <input id="ship_estimation" type="text" value="" name="shipping_estimation" hidden readonly>
                                                
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
                                                    name="grand_total_price" hidden readonly>
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
                                    <div class="custome-radio">

                                        <input class="form-check-input" required="" type="radio"
                                            name="payment_option" value="midtrans" id="exampleRadios3"
                                            checked="">

                                        <label class="form-check-label" for="exampleRadios3"
                                            data-bs-toggle="collapse" data-target="#bankTranfer"
                                            aria-controls="bankTranfer">Midtrans</label>
                                    </div>
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
                    url: '/cities/' + provindeId,
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
                    url: '/cities/' + provindeId,
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
        //ajax check ongkir
        let isProcessing = false;
        $('#check-ongkir').on('change', function(e) {
            e.preventDefault();

            
            $('#loading-ongkir').html('<img src="{{ asset('frontend/assets/imgs/theme/ongkir-loading.gif') }}" alt="loading ongkir" /><h6>Mohon Menunggu...</h6>');
            $('#ongkir').empty();

            let token = $("meta[name='csrf-token']").attr("content");
            let city_origin = $('select[name=city_origin]').val();
            let city_destination = $('select[name=city_destination]').val();
            let courier = $('select[name=courier]').val();
            let weight = $('#weight').val();

            
            if (isProcessing) {
                return;
            }
            
            isProcessing = true;
            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token: token,
                    city_origin: city_origin,
                    city_destination: city_destination,
                    courier: courier,
                    weight: weight,
                },
                dataType: "JSON",
                type: "POST",
                success: function(response) {
                    $('#loading-ongkir').html('');
                    isProcessing = false;
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        $.each(response[0]['costs'], function(key, value) {
                            $('#ongkir').append(
                                '<li class="list-group-item"><input onchange="displayRadioValue()" id="kurir-price" class="ongkir-price form-check-input"' +
                                'value="' + value.cost[
                                    0].value + ' ' + value.service + ' ' + value
                                .cost[0].etd + '"' +
                                'type="radio" name="ongkir-price">' +
                                response[0].code.toUpperCase() + ' : <strong>' +
                                value.service + '</strong> - Rp. ' + value.cost[
                                    0].value + ' (' + value.cost[0].etd +
                                ' hari)</li>')
                        });

                    }
                }
            });

        });

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

@endsection
