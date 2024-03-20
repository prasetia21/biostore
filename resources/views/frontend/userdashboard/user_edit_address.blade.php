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



                                                <form method="post" action="{{ route('user.address.update') }}" >
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
                                                            <input class="form-control" name="user_id" type="number" hidden value="{{ Auth::user()->id }}" />
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>No Telp / WA</label>
                                                            <input
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                name="phone" type="number" id="phone" value="{{ !empty($address->phone) ? $address->phone : '-' }}"/>

                                                            @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <label>Alamat Lengkap</label>
                                                            <input class="form-control" name="address"
                                                                type="text" id="address"
                                                                value="{{ !empty($address->address) ? $address->address : '-' }}" />

                                                        </div>

                                                        <div class="w-100">
                                                            <div class="form-group col-lg-12">
                                                                <label for="provinsi" class="form-label">Pilih Provinsi</label><br />
                                                                <select class="form-control provinsi-tujuan" name="province_destination"
                                                                    id="provinsi" required>
                                                                    <option value="{{ !empty($address->ninja_province_id) ? $address->ninja_province_id : '-' }}">{{ !empty($addressProvince->name) ? $addressProvince->name : '-' }}</option>
                                                                    @foreach ($provinces as $province => $value)
                                                                        <option value="{{ $province ?? '' }}">{{ $value ?? '' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-lg-12 mt-40">
                                                                <label for="kota" class="form-label">Pilih Kota / Kabupaten</label><br />
                                                                <select class="form-control kota-tujuan" name="city_destination" id="kota"
                                                                    required>
                                                                    <option value="{{ !empty($address->ninja_regency_id) ? $address->ninja_regency_id : '-' }}">{{ !empty($addressCity->name) ? $addressCity->name : '-' }}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-lg-12 mt-40">
                                                                <label for="kecamatan_" class="form-label">Pilih Kecamatan...</label><br />
                                                                <select class="form-control kecamatan-tujuan" name="kecamatan_destination" id="kota"
                                                                    required>
                                                                    <option value="{{ !empty($address->ninja_district_id) ? $address->ninja_district_id : '-' }}">{{ !empty($addressDistrict->name) ? $addressDistrict->name : '-' }}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 mt-60">
                                                            <label>Kode Pos <span class="required">*</span></label>
                                                            <input
                                                                class="form-control @error('post_code') is-invalid @enderror"
                                                                name="post_code" type="number" id="post_code" value="{{ !empty($address->post_code) ? $address->post_code : '-' }}"
                                                                />

                                                            @error('post_code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-12 mb-20">
                                                            <textarea rows="5" value="{{ !empty($address->note) ? $address->note : '-' }}" name="note"></textarea>
                                                        </div>

                                                        <div class="form-check form-switch mb-30" hidden>
                                                            <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" id="status" 
                                                            name="status" checked>
                                                            <label class="form-check-label" for="status">Jadikan Alamat Utama<span class="required">*</span></label>
                                                            @error('status')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-fill-out submit font-weight-bold"
                                                                name="submit" value="Submit">Edit Alamat</button>
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
    
        });
    </script>

@endsection
