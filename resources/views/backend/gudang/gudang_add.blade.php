@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tambah Gudang </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Gudang </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">

                                <form id="myForm" method="post" action="{{ route('store.gudang') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-body mt-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="border border-3 p-4 rounded">


                                                    <div class="form-group mb-3">
                                                        <label for="inputLabelGudang" class="form-label">Label <span
                                                                style="color: red">(*)</span> </label>
                                                        <input type="text" name="label" class="form-control"
                                                            id="inputLabelGudang" placeholder="Masukkan label gudang">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="inputPIC" class="form-label">Nama
                                                            PIC <span style="color: red">(*)</span></label>
                                                        <input type="text" name="pic_name" class="form-control"
                                                            id="inputPIC" placeholder="Masukkan Nama PIC Gudang">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="border border-3 p-4 rounded">
                                                    <div class="row g-3">

                                                        <div class="form-group col-md-6">
                                                            <label for="provinsi" class="form-label">Provinsi <span
                                                                    style="color: red">(*)</span></label><br />
                                                            <select class="form-control provinsi-tujuan"
                                                                name="ninja_province_id" id="provinsi" required>
                                                                <option value="0">-- pilih provinsi --</option>
                                                                @foreach ($provinces as $province => $value)
                                                                    <option value="{{ $province ?? '' }}">
                                                                        {{ $value ?? '' }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="kota" class="form-label">Kota <span
                                                                    style="color: red">(*)</span></label><br />
                                                            <select class="form-control kota-tujuan" name="ninja_regency_id"
                                                                id="kota" required>
                                                                <option>Pilih Kota / Kabupaten...</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="kecamatan" class="form-label">Kecamatan <span
                                                                    style="color: red">(*)</span></label><br />
                                                            <select class="form-control kecamatan-tujuan"
                                                                name="ninja_district_id" id="kecamatan" required>
                                                                <option>Pilih Kecamatan...</option>
                                                            </select>
                                                        </div>


                                                        <div class="form-group col-md-6">
                                                            <label for="inputPostCode" class="form-label">Kode Pos <span
                                                                    style="color: red">(*)</span></label>
                                                            <input type="text" name="post_code" class="form-control"
                                                                id="inputPostCode" placeholder="Masukkan Kode Pos">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="inputPhone1" class="form-label">Nomor
                                                                Telepon <span style="color: red">(*)</span></label>
                                                            <input type="text" name="phone_1" class="form-control"
                                                                id="inputPhone1" placeholder="081xxxxxxx">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="inputPhone1" class="form-label">Nomor Telepon
                                                                Cadangan</label>
                                                            <input type="text" name="phone_2" class="form-control"
                                                                id="inputPhone2" placeholder="081xxxxxxx">
                                                        </div>


                                                        <hr>

                                                        <div class="form-group mb-3">
                                                            <label for="inputAlamat" class="form-label">Alamat Lengkap <span
                                                                    style="color: red">(*)</span></label>
                                                            <textarea name="address" class="form-control" id="inputAlamat" rows="3"></textarea>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="d-grid">
                                                                <input type="submit" class="btn btn-primary px-4"
                                                                    value="Simpan Perubahan" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--end row-->
                                    </div>


                                </form>


                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    label: {
                        required: true,
                    },

                    pic_name: {
                        required: true,
                    },

                    ninja_province_id: {
                        required: true,
                    },

                    ninja_regency_id: {
                        required: true,
                    },

                    ninja_district_id: {
                        required: true,
                    },

                    post_code: {
                        required: true,
                    },

                    phone_1: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                },
                messages: {
                    label: {
                        required: 'Masukkan Label Gudang',
                    },
                    pic_name: {
                        required: 'Masukkan Nama PIC Gudang',
                    },
                    ninja_province_id: {
                        required: 'Masukkan Provinsi',
                    },
                    ninja_regency_id: {
                        required: 'Masukkan Kota',
                    },
                    ninja_district_id: {
                        required: 'Masukkan Kecamatan',
                    },
                    post_code: {
                        required: 'Masukkan Kode Pos',
                    },
                    phone_1: {
                        required: 'Masukkan Nomor Telepon',
                    },
                    address: {
                        required: 'Masukkan Alamat',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script>
       $(document).ready(function() {
    
        //ajax select kota tujuan
        $('select[name="ninja_province_id"]').on('change', function() {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/ninjacity/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('select[name="ninja_regency_id"]').empty();
                        $('select[name="ninja_regency_id"]').append(
                            '<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="ninja_regency_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="ninja_regency_id"]').append(
                    '<option value="">-- pilih kota tujuan --</option>');
            }
        });
        $('select[name="ninja_regency_id"]').on('change', function() {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/ninjadistricts/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('select[name="ninja_district_id"]').empty();
                        $('select[name="ninja_district_id"]').append(
                            '<option value="">-- pilih kecamatan tujuan --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="ninja_district_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="ninja_district_id"]').append(
                    '<option value="">-- pilih kecamatan tujuan --</option>');
            }
        });
       
    });
    </script>
@endsection
