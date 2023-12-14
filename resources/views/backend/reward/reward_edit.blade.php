@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Item Reward</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Item Reward</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Item Reward</h5>
                <hr />

                <form id="myForm" method="post" action="{{ route('update.reward') }}">
                    @csrf

                    <input type="hidden" name="id" value="{{ $rewards->id }}">

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">


                                    <div class="form-group mb-3">
                                        <label for="inputRewardTitle" class="form-label">Nama Reward</label>
                                        <input type="text" name="reward_name" class="form-control"
                                            id="inputRewardTitle" value="{{ $rewards->reward_name }}">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="inputRewardDescription" class="form-label">Deskripsi</label>
                                        <textarea name="reward_desc" class="form-control" id="inputRewardDescription" rows="3">
                                            {{ $products->reward_desc }}
                                        </textarea>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">

                                        <div class="form-group col-md-6">
                                            <label for="inputRewardQty" class="form-label">Quantity</label>
                                            <input type="text" name="reward_qty" class="form-control" id="inputRewardQty"
                                                value="{{ $rewards->reward_qty }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputRendeemAmount" class="form-label">Rendeem Amount </label>
                                            <input type="text" name="rendeem_amount" class="form-control"
                                                id="inputRendeemAmount" value="{{ $rewards->rendeem_amount }}">
                                        </div>
      
                                        <div class="form-group col-12">
                                            <label for="inputVoucherType" class="form-label">Voucher (Opsional)</label>
                                            <select name="voucher_id" class="form-select" id="inputVoucherType">
                                                <option></option>
                                                @foreach ($vouchers as $voucher)
                                                    <option value="{{ $voucher->id }}"
                                                        {{ $voucher->id == $products->voucher_id ? 'selected' : '' }}>
                                                        {{ $voucher->voucher_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="form-group col-12">
                                            <label for="inputCoupon" class="form-label">Coupon (Opsional)</label>
                                            <select name="coupon_id" class="form-select" id="inputCoupon">
                                                <option></option>
                                                @foreach ($coupons as $coupon)
                                                    <option value="{{ $coupon->id }}"
                                                        {{ $coupon->id == $coupons->coupon_id ? 'selected' : '' }}>
                                                        {{ $coupon->coupon_name }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}


                                        
                                        <hr>


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
            </div>

            </form>

        </div>

    </div>


    <!-- /// Main Image Thumbnail Update ////// -->

    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Gambar Thumbnail </h6>
        <hr>
        <div class="card">
            <form method="post" action="{{ route('update.reward.thumbnail') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $rewards->id }}">
                <input type="hidden" name="old_img" value="{{ $rewards->reward_thumbnail }}">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Pilih Gambar Thumbnail </label>
                        <input name="reward_thumbnail" class="form-control" type="file" id="formFile">
                    </div>


                    <div class="mb-3">
                        <label for="formFile" class="form-label"> </label>
                        <img src="{{ asset($rewards->reward_thumbnail) }}" style="width:100px; height:100px">
                    </div>

                    <input type="submit" class="btn btn-primary px-4" value="Simpan Perubahan" />

                </div>

            </form>

        </div>
    </div>


    <!-- /// End Main Image Thumbnail Update ////// -->


    <!-- /// Main Image Update ////// -->

    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Gambar </h6>
        <hr>
        <div class="card">
            <form method="post" action="{{ route('update.reward.image') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $rewards->id }}">
                <input type="hidden" name="old_img" value="{{ $rewards->reward_image }}">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Pilih Gambar Image </label>
                        <input name="reward_image" class="form-control" type="file" id="formFile">
                    </div>


                    <div class="mb-3">
                        <label for="formFile" class="form-label"> </label>
                        <img src="{{ asset($rewards->reward_image) }}" style="width:100px; height:100px">
                    </div>

                    <input type="submit" class="btn btn-primary px-4" value="Simpan Perubahan" />

                </div>

            </form>

        </div>
    </div>


    <!-- /// End Main Image Update ////// -->




    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    reward_name: {
                        required: true,
                    },
                    reward_desc: {
                        required: true,
                    },
                    reward_thumbnail: {
                        required: true,
                    },
                    reward_image: {
                        required: true,
                    },
                    reward_qty: {
                        required: true,
                    },
                    rendeem_amount: {
                        required: true,
                    },
                    voucher_id: {
                        required: false,
                    },
                    // coupon_id: {
                    //     required: false,
                    // },
                },
                messages: {
                    reward_name: {
                        required: Masukkan Nama Item Reward,
                    },
                    reward_desc: {
                        required: Masukkan Deskripsi Item Reward,
                    },
                    reward_thumbnail: {
                        required: Pilih Gambar Thumbnail Item Reward,
                    },
                    reward_image: {
                        required: Pilih Gambar Item Reward,
                    },
                    reward_qty: {
                        required: Masukkan Quantity Item Reward,
                    },
                    rendeem_amount: {
                        required: Masukkan Jumlah Penukaran Item Reward,
                    },
                    voucher_id: {
                        required: Pilih Voucher (Opsional),
                    },
                    // coupon_id: {
                    //     required: Pilih Voucher (Coupon),
                    // },

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
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function mainImgUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainImg').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
