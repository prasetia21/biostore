@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Produk</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Produk</h5>
                <hr />

                <form id="myForm" method="post" action="{{ route('update.product') }}">
                    @csrf

                    <input type="hidden" name="id" value="{{ $products->id }}">

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">


                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Nama Produk</label>
                                        <input type="text" name="product_name" class="form-control"
                                            id="inputProductTitle" value="{{ $products->product_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Tag</label>
                                        <input type="text" name="product_tags" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_tags }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductType" class="form-label">Kemasan</label>
                                        <select name="product_size" class="form-select" id="inputProductType">
                                            <option value="{{ $products->product_size }}"
                                                {{ $products->product_size ? 'selected' : '' }}>
                                                {{ $products->product_size }}</option>
                                            <option>Can</option>
                                            <option>Cup</option>
                                            <option>Jar</option>
                                            <option>Botol</option>
                                            <option>Pail</option>
                                        </select>
                                    </div>


                                    {{-- <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Warna</label>
                                        <input type="text" name="product_color" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_color }}">
                                    </div> --}}



                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Deskripsi Singkat</label>
                                        <textarea name="short_desc" class="form-control" id="inputProductDescription" rows="3">
        {{ $products->short_desc }}
				</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Deskripsi Lengkap</label>
                                        <textarea id="mytextarea" name="long_desc">
				 {!! $products->long_desc !!}</textarea>
                                    </div>






                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">

                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Harga</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice"
                                                value="{{ $products->selling_price }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Diskon </label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="inputCompareatprice" value="{{ $products->discount_price }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Kode Produk</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" value="{{ $products->product_code }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStarPoints" class="form-label">Quantity</label>
                                            <input type="text" name="product_qty" class="form-control"
                                                id="inputStarPoints" value="{{ $products->product_qty }}">
                                        </div>


                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option></option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Kategori</label>
                                            <select name="category_id" class="form-select" id="inputVendor">
                                                <option></option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $cat->id == $products->category_id ? 'selected' : '' }}>
                                                        {{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputCollection" class="form-label">Sub-Kategori</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($subcategory as $subcat)
                                                    <option value="{{ $subcat->id }}"
                                                        {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>
                                                        {{ $subcat->subcategory_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <!-- <div class="col-12">
                 <label for="inputCollection" class="form-label">Select Vendor</label>
                 <select name="vendor_id" class="form-select" id="inputCollection">
                  <option></option>
                 @foreach ($activeVendor as $vendor)
    <option value="{{ $vendor->id }}" {{ $vendor->id == $products->vendor_id ? 'selected' : '' }}>{{ $vendor->name }}</option>
    @endforeach
                 </select>
                </div> -->


                                        <div class="col-12">

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->featured == 1 ? 'checked' : '' }}>
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
            </div>

            </form>

        </div>

    </div>


    <!-- /// Main Image Thumbnail Update ////// -->

    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Gambar Thumbnail </h6>
        <hr>
        <div class="card">
            <form method="post" action="{{ route('update.product.thumbnail') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $products->id }}">
                <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Pilih Gambar Thumbnail </label>
                        <input name="product_thumbnail" class="form-control" type="file" id="formFile">
                    </div>


                    <div class="mb-3">
                        <label for="formFile" class="form-label"> </label>
                        <img src="{{ asset($products->product_thumbnail) }}" style="width:100px; height:100px">
                    </div>

                    <input type="submit" class="btn btn-primary px-4" value="Simpan Perubahan" />

                </div>

            </form>

        </div>
    </div>


    <!-- /// End Main Image Thumbnail Update ////// -->

    <!-- /// Update Multi Image  ////// -->

    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Gambar Feature </h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Ganti Image </th>
                            <th scope="col">Delete </th>
                        </tr>
                    </thead>
                    <tbody>

                        <form method="post" action="{{ route('update.product.multiimage') }}"
                            enctype="multipart/form-data">
                            @csrf

                            @foreach ($multiImgs as $key => $img)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td> <img src="{{ asset($img->photo_name) }}" style="width:70; height: 40px;"> </td>
                                    <td> <input type="file" class="form-group" name="multi_img[{{ $img->id }}]">
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-primary px-4" value="Update Image " />
                                        <a href="{{ route('product.multiimg.delete', $img->id) }}" class="btn btn-danger"
                                            id="delete"> Delete </a>
                                    </td>
                                </tr>
                            @endforeach

                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /// End Update Multi Image  ////// -->





    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    short_descp: {
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
                    product_code: {
                        required: true,
                    },
                    product_qty: {
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
                    short_descp: {
                        required: 'Masukkan Deskripsi Singkat',
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
@endsection
