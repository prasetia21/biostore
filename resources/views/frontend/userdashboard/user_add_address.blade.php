@extends('dashboard')
@section('user')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/dashboard') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Dashboard</a>
                <span></span> Alamat
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
                                <div class="tab-content account dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Tambah Alamat Pengiriman</h5>
                                            </div>
                                            <div class="card-body">



                                                <form method="post" action="{{ route('user.address.store') }}">
                                                    @csrf

                                                    @if (session('status'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session('status') }}
                                                        </div>
                                                    @elseif(session('error'))
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif


                                                    <div class="row">

                                                        <div class="form-group col-md-12">
                                                            <input class="form-control" name="user_id" type="number"
                                                                readonly hidden value="{{ Auth::user()->id }}" />
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>No Telp / WA</label>
                                                            <input class="form-control @error('phone') is-invalid @enderror"
                                                                name="phone" type="number" id="phone"
                                                                placeholder="Masukkan No Telp / WA Aktif" />

                                                            @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <label>Alamat Lengkap</label>
                                                            <input class="form-control" name="address" type="text"
                                                                id="address" placeholder="Masukkan Alamat Lengkap" />

                                                        </div>

                                                        <div class="w-100">
                                                            <div class="form-group col-lg-12">
                                                                <label for="provinsi" class="form-label">Pilih
                                                                    Provinsi</label><br />
                                                                <select class="form-control provinsi-tujuan"
                                                                    name="province_destination" id="provinsi" required>
                                                                    <option value="0">-- pilih provinsi --</option>
                                                                    @foreach ($provinces as $province => $value)
                                                                        <option value="{{ $province ?? '' }}">
                                                                            {{ $value ?? '' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-lg-12 mt-5">
                                                                <label for="kota" class="form-label">Pilih Kota /
                                                                    Kabupaten</label><br />
                                                                <select class="form-control kota-tujuan"
                                                                    name="city_destination" id="kota" required>
                                                                    <option>Pilih Kota / Kabupaten...</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-lg-12 mt-5">
                                                                <label for="kecamatan" class="form-label">Pilih
                                                                    Kecamatan</label><br />
                                                                <select class="form-control kecamatan-tujuan"
                                                                    name="kecamatan_destination" id="kecamatan" required>
                                                                    <option>Pilih Kecamatan...</option>
                                                                </select>
                                                            </div>

                                                            <input required="" type="text" name="to_kecamatan_kirim"
                                                                id="to_kecamatan_kirim" readonly hidden>
                                                            <input required="" type="text" name="to_kota_kirim"
                                                                id="to_kota_kirim" readonly hidden>
                                                            <input required="" type="text" name="to_provinsi_kirim"
                                                                id="to_provinsi_kirim" readonly hidden>


                                                            <input required="" type="text" name="to_l1_tier_code"
                                                                id="toL1TierCode" readonly hidden>
                                                            <input required="" type="text" name="to_l2_tier_code"
                                                                id="toL2TierCode" readonly hidden>

                                                        </div>

                                                        <div class="form-group col-md-12 mt-60">
                                                            <label>Kode Pos <span class="required">*</span></label>
                                                            <input
                                                                class="form-control @error('post_code') is-invalid @enderror"
                                                                name="post_code" type="number" id="post_code" />

                                                            @error('post_code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-12 mb-20">
                                                            <textarea rows="5"
                                                                placeholder="Tambahan informasi, Ancer-ancer, RT/RW, No Jalan, Apartement, Per4an/Per3an, dll (Opsional)"
                                                                name="note"></textarea>
                                                        </div>

                                                        <div class="form-check form-switch mb-30" hidden>
                                                            <input
                                                                class="form-check-input @error('status') is-invalid @enderror"
                                                                type="checkbox" id="status" name="status" checked>
                                                            <label class="form-check-label" for="status">Jadikan Alamat
                                                                Utama<span class="required">*</span></label>
                                                            @error('status')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-fill-out submit font-weight-bold"
                                                                name="submit" value="Submit">Tambah Alamat Baru</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

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



                        

                        },
                    });
                } else {
                    $('input[name="to_l1_tier_code"]').empty();
                    $('input[name="to_l2_tier_code"]').empty();
                }
            });

        });
    </script>
@endsection
