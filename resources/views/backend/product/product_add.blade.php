@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#select-field').select2({
            theme: 'bootstrap-5'
        });
    </script>

    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tambah Produk Baru</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Produk Baru</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Tambah Produk Baru</h5>
                <hr />

                <form id="myForm" method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">


                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Nama Produk</label>
                                        <input type="text" name="product_name" class="form-control"
                                            id="inputProductTitle" placeholder="Enter product title">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Tag</label>
                                        <input type="text" name="product_tags" class="form-control visually-hidden"
                                            data-role="tagsinput" value="best seller,top product">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductType" class="form-label">Kemasan</label>
                                        <select name="product_size" class="form-select" id="inputProductType">
                                            <option>Can</option>
                                            <option>Cup</option>
                                            <option>Jar</option>
                                            <option>Botol</option>
                                            <option>Pail</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Warna</label>

                                        <select name="product_color[]" class="form-select" id="multiple-select-field-color"
                                            data-placeholder="Pilihan Warna" multiple>
                                            <option></option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->color_name }}">{{ $color->color_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="form-group
                                            mb-3">
                                        <label for="inputProductDescription" class="form-label">Deskripsi
                                            Singkat</label>
                                        <textarea name="short_desc" class="form-control" id="inputProductDescription" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Deskripsi Lengkap</label>
                                        <textarea id="mytextarea" name="long_desc">Loreng Ipsun</textarea>
                                    </div>



                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Thumbnail</label>
                                        <input name="product_thumbnail" class="form-control" type="file" id="formFile"
                                            onChange="mainThamUrl(this)">

                                        <img src="" id="mainThmb" />
                                    </div>



                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Featured Image</label>
                                        <input class="form-control" name="multi_img[]" type="file" id="multiImg"
                                            multiple="">

                                        <div class="row" id="preview_img"></div>

                                    </div>



                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">

                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Harga</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice"
                                                placeholder="00.00">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Harga Diskon </label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="inputCompareatprice" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Kode Produk</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStarPoints" class="form-label">Quantity</label>
                                            <input type="text" name="product_qty" class="form-control"
                                                id="inputStarPoints" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputWeight" class="form-label">Berat Kemasan</label>
                                            <input type="text" name="product_weight" class="form-control"
                                                id="inputWeight" placeholder="00.00">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="inputDimensionX" class="form-label">Panjang</label>
                                            <input type="text" name="product_dimension_x" class="form-control"
                                                id="inputDimensionX" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputDimensionY" class="form-label">Lebar</label>
                                            <input type="text" name="product_dimension_y" class="form-control"
                                                id="inputDimensionY" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputDimensionZ" class="form-label">Tinggi</label>
                                            <input type="text" name="product_dimension_z" class="form-control"
                                                id="inputDimensionZ" placeholder="00.00">
                                        </div>


                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option></option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Kategori</label>
                                            <select name="category_id" class="form-select" id="inputVendor">
                                                <option></option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputCollection" class="form-label">Sub-Kategori</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option></option>

                                            </select>
                                        </div>

                                        <div class="col-12">

                                            <div class="row g-3">

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1" id="flexCheckDefault">
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>

                                            </div> <!-- // end row  -->

                                        </div>

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


                </form>

            </div>

        </div>

    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_qty: {
                        required: true,
                    },
                    product_dimension_x: {
                        required: true,
                    },
                    product_dimension_y: {
                        required: true,
                    },
                    product_dimension_z: {
                        required: true,
                    },
                    short_desc: {
                        required: true,
                    },
                    long_desc: {
                        required: true,
                    },
                    product_thumbnail: {
                        required: true,
                    },
                    multi_img: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    brand_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Masukkan Nama Produk',
                    },
                    short_desc: {
                        required: 'Masukkan Deskripsi Singkat',
                    },
                    long_desc: {
                        required: 'Masukkan Deskripsi Lengkap',
                    },
                    product_thumbnail: {
                        required: 'Pilih Gambar Produk untuk Thumbnail',
                    },
                    multi_img: {
                        required: 'Pilih Gambar untuk Featured Image',
                    },
                    selling_price: {
                        required: 'Masukkan Harga Jual Produk',
                    },
                    product_code: {
                        required: 'Masukkan Kode Produk',
                    },
                    product_qty: {
                        required: 'Masukkan Quantity Produk',
                    },
                    product_dimension_x: {
                        required: 'Masukkan Dimensi Panjang Produk',
                    },
                    product_dimension_y: {
                        required: 'Masukkan Dimensi Lebar Produk',
                    },
                    product_dimension_z: {
                        required: 'Masukkan Dimensi Tinggi Produk',
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



    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>


    <script>
        $('#multiple-select-field-size').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });

        $('#multiple-select-field-color').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>
@endsection
