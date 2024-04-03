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
            <div class="breadcrumb-title pe-3">Tambah Paket Baru</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Paket Baru</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Tambah Paket Bundling Baru</h5>
                <hr />

                <form id="myForm" method="post" action="{{ route('store.paket') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">


                                    <div class="form-group mb-3">
                                        <label for="namaPaket" class="form-label">Nama Paket</label>
                                        <input type="text" name="nama_paket" class="form-control"
                                            id="namaPaket" placeholder="Masukkan nama paket bundling">
                                    </div>

                                   
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Pilihan Produk</label>

                                        <select name="product_id[]" class="form-select" id="multiple-select-field-product"
                                            data-placeholder="Pilihan Produk" multiple>
                                            <option></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputPrice" class="form-label">Harga</label>
                                        <input type="text" name="new_price" class="form-control" id="inputPrice"
                                            placeholder="00.00">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputQty" class="form-label">Quantity</label>
                                        <input type="text" name="qty" class="form-control"
                                            id="inputQty" placeholder="00.00">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Thumbnail</label>
                                        <input name="image" class="form-control" type="file" id="formFile"
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
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary px-4"
                                                value="Simpan Perubahan" />

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
                    nama_paket: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Masukkan Nama Paket',
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

    <script>

        $('#multiple-select-field-product').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>
@endsection
