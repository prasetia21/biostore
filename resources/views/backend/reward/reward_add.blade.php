@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tambah Item Reward Baru</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Item Reward Baru</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Tambah Item Reward Baru</h5>
                <hr />

                <form id="myForm" method="post" action="{{ route('store.reward') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">


                                    <div class="form-group mb-3">
                                        <label for="inputRewardTitle" class="form-label">Nama Reward</label>
                                        <input type="text" name="reward_name" class="form-control" id="inputRewardTitle"
                                            placeholder="Enter reward title">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputRewardDescription" class="form-label">Deskripsi</label>
                                        <textarea name="reward_desc" class="form-control" id="inputRewardDescription" rows="3"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputRewardQty" class="form-label">Quantity</label>
                                        <input type="text" name="reward_qty" class="form-control" id="inputRewardQty"
                                            placeholder="00.00">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputRendeemAmount" class="form-label">Rendeem Amount (BioPoint)</label>
                                        <input type="text" name="rendeem_amount" class="form-control"
                                            id="inputRendeemAmount" placeholder="00.00">
                                    </div>





                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">

                                        <div class="form-group mb-3">
                                            <label for="inputRewardTitle" class="form-label">Thumbnail</label>
                                            <input name="reward_thumbnail" class="form-control" type="file"
                                                id="formFile" onChange="mainThamUrl(this)">

                                            <img src="" id="mainThmb" />
                                        </div>



                                        <div class="form-group mb-3">
                                            <label for="inputProductTitle" class="form-label">Image</label>
                                            <input class="form-control" name="image_name[]" type="file" id="multiImg"
                                                multiple="">

                                            <div class="row" id="preview_img"></div>

                                        </div>


                                        <div class="card mt-4">
                                            <h5 class="card-header">Featured (Untuk Penukaran Voucher / Coupon)</h5>
                                            <div class="card-body">
                                                <div class="form-group col-12">
                                                    <label for="inputVoucherType" class="form-label">Voucher
                                                        (Opsional)</label>
                                                    <select name="voucher_id" class="form-select" id="inputVoucherType">
                                                        <option></option>
                                                        @foreach ($vouchers as $voucher)
                                                            <option value="{{ $voucher->id }}">{{ $voucher->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- <div class="form-group col-12">
                                                    <label for="inputCoupon" class="form-label">Coupon (Opsional)</label>
                                                    <select name="coupon_id" class="form-select" id="inputCoupon">
                                                        <option></option>
                                                        @foreach ($coupons as $coupon)
                                                            <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                            </div>
                                        </div>


                                        <!-- // end row  -->
                                    </div>


                                </div>


                            </div>



                            <hr>


                            <div class="col-12">
                                <div class="d-grid">
                                    <input type="submit" class="btn btn-primary px-4" value="Simpan Perubahan" />

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
                    image_name: {
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
                    coupon_id: {
                        required: false,
                    },
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
                    image_name: {
                        required: Pilih Gambar Item Reward,
                    },
                    reward_qty: {
                        required: Masukkan Quantity Item Reward,
                    },
                    rendeem_amount: {
                        required: Masukkan Jumlah Penukaran Item Reward,
                    },
                    voucher_id: {
                        required: Pilih Voucher(Opsional),
                    },
                    coupon_id: {
                        required: Pilih Voucher(Coupon),
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

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
