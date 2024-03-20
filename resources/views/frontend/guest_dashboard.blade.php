<!DOCTYPE html>
<html class="no-js" lang="en">

@php
    $seo = App\Models\Seo::find(1);
@endphp

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keywords" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />

        


    {{-- New Template --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/new/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/media-query.css') }}" />
</head>

<body>
    <div class="site_content">
        <!-- Modal -->

        <!-- Quick view -->
        @include('frontend.body.guest.quickview')
        <!-- Header  -->

        @include('frontend.body.guest.header')
        <!--End header-->

        <!-- Search  -->

        @include('frontend.body.guest.search')
        <!--End Search-->



        <main class="main">
            @yield('main')

        </main>

        @include('frontend.body.guest.footer')



        <!-- Preloader Start -->
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="text-center">
                        <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    {{-- NEW Template JS --}}
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/new/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/new/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/new/js/custom.js') }}"></script>

    

    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
    


    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr()->info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr()->success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr()->warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr()->error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <script>
        function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>Pilih Salah Satu</option>');

                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
       
    </script>



    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        /// Start product view with Modal 

        function productView(id) {
            // alert(id)
            $.ajax({
                type: 'GET',
                url: '/guest/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#pname').text(data.product.product_name);
                    $('#pprice').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name);
                    $('#pbrand').text(data.product.brand.brand_name);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                    $('#pvendor_id').text(data.product.vendor_id);

                    $('#product_weight').text(data.product.product_weight);
                    $('#product_dimension_x').text(data.product.product_dimension_x);
                    $('#product_dimension_y').text(data.product.product_dimension_y);
                    $('#product_dimension_z').text(data.product.product_dimension_z);

                    $('#product_id').val(id);
                    $('#qty').val(1);


                    // Product Price 
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);

                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    } // end else


                    /// Start Stock Option

                    if (data.product.product_qty > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('aviable');

                    } else {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    }
                    ///End Start Stock Option

                    ///Size 

                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value="' + value + ' ">' + value +
                            '  </option')
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    }) // end size


                    ///Color 
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value="' + value + ' ">' + value +
                            '  </option')
                        if (data.color == "") {
                            $('#colorArea').hide();
                        } else {
                            $('#colorArea').show();
                        }
                    }) // end size




                }
            })
        }

        // End Product View With Modal 

        /// Start Add To Cart Prodcut 

        function addToCart() {

            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    quantity: quantity,
                    product_name: product_name,
                },
                url: "/guest/cart/data/store/" + id,
                success: function(data) {
                    miniCart();
                    $('#closeModal').click();
                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  
                }
            })

        }

        /// End Add To Cart Product 


        /// Start Details Page Add To Cart Product 

        function addToCartDetails() {

            var product_name = $('#dpname').text();
            var id = $('#dproduct_id').val();
            var quantity = $('#dqty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    quantity: quantity,
                    product_name: product_name,
                },
                url: "/guest/dcart/data/store/" + id,
                success: function(data) {
                    miniCart();
                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  
                }
            })

        }

        /// Eend Details Page Add To Cart Product 
    </script>


    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/guest/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = ""

                    $.each(response.carts, function(key, value) {
                        miniCart += ` <ul>
            <li>
                <div class="shopping-cart-img">
                    <a><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                </div>
                <div class="shopping-cart-title" style="margin: -50px 74px 14px; width" 146px;>
                    <h4><a> ${value.name} </a></h4>
                    <h4><span>${value.qty} × </span>${value.price}</h4>
                </div>
                <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                    <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"  ><i class="fi-rs-cross-small"></i></a>
                </div>
            </li> 
        </ul>
        <hr><br>  
               `
                    });

                    $('#miniCart').html(miniCart);

                }

            })
        }
        miniCart();


        /// Mini Cart Remove Start 
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/guest/minicart/product/remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  

                }



            })
        }



        /// Mini Cart Remove End 
    </script>

    <!--  /// Start Wishlist Add -->
    <script type="text/javascript">
        function addToWishList(product_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/guest/add-to-wishlist/" + product_id,

                success: function(data) {
                    wishlist();
                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  


                }
            })
        }
    </script>
    <!--  /// End Wishlist Add -->


    <!--  // Start Load MY Cart // -->
    <script type="text/javascript">
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/guest/get-cart-product',
                dataType: 'json',
                success: function(response) {

                    var rows = ""

                    $.each(response.carts, function(key, value) {
                        rows += `<tr class="pt-30">
            <td class="custome-checkbox pl-30">
                 
            </td>
            <td class="image product-thumbnail pt-20">
                <h6 class="mb-1"><a class="product-name mb-10 text-heading">${value.name} </a></h6>
                <img src="/${value.options.image} " alt="#">
            </td>
            
            <td class="price" data-title="Price">
                <h6 class="text-body">Rp.${value.price} </h6>
            </td>


            <td class="text-center detail-info" data-title="Stock">
                <div class="detail-extralink mr-15">
                    <div class="detail-qty border radius">
                        
     <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>
                       
      <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">

     <a  type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>

                    </div>
                </div>
            </td>
            <td class="price" data-title="Price">
                <h6 class="text-brand">Rp.${value.subtotal} </h6>
            </td>
            <td class="action text-center" data-title="Remove">
            <a type="submit" class="text-body"  id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a></td>
        </tr>`
                    });

                    $('#cartPage').html(rows);

                }

            })
        }
        cart();

        // Cart Remove Start 
        function cartRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/guest/cart-remove/" + id,

                success: function(data) {
                    cart();
                    miniCart();
                    couponCalculation();
                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  


                }
            })
        }
        // Cart Remove End 

        // Cart INCREMENT 

        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/guest/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();

                }
            });
        }


        // Cart INCREMENT End 

        // Cart Decrement Start

        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/guest/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();

                }
            });
        }


        // Cart Decrement End 
    </script>
    <!--  // End Load MY Cart // -->

    <script type="text/javascript">
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();
            
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    coupon_name: coupon_name
                },

                url: "/guest/coupon-apply",

                success: function(data) {
                    couponCalculation();

                    if (data.validity == true) {
                        $('#couponField').hide();
                    }

                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  
                }
            })
        }

        // Start CouponCalculation Method   
        function couponCalculation() {

            $.ajax({
                type: 'GET',
                url: "/guest/coupon-calculation",
                dataType: 'json',
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Total Harga (Termasuk Pajak 11%)</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">Rp.${parseInt(data.total).toLocaleString()}</h4>
                                </td>
                            </tr>`
                        )
                    } else {
                        $('#couponCalField').html(
                            `<tr> 
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">Rp.${parseInt(data.subtotal).toLocaleString()}</h4>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">${data.coupon_name} <a type="submit" onclick="couponRemove()"><i class="fi-rs-trash"></i> </a> </h6>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Discount Amount  </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">Rp.${parseInt(data.discount_amount).toLocaleString()}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Grand Total </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">Rp.${parseInt(data.total_amount).toLocaleString()}</h4>
                                </td>
                            </tr>`
                        )
                    }

                }
            })
        }

        couponCalculation();
        // Start CouponCalculation Method   
    </script>

    <script type="text/javascript">
        // Coupon Remove Start 
        function couponRemove() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/guest/coupon-remove",

                success: function(data) {
                    couponCalculation();
                    $('#couponField').show();
                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  


                }
            })
        }
        // Coupon Remove End 
    </script>


    {{-- Add Coupon Beta --}}
    <script type="text/javascript">
        function applyCouponFix() {
            var coupon_name = $('#coupon_name').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    coupon_name: coupon_name
                },

                url: "/guest/coupon-apply",

                success: function(data) {
                    couponCalculationFix();

                    if (data.validity == true) {
                        $('#couponField').hide();
                        $('#noCouponApply').hide();
                        $('#noCoupon').hide();
                        $('#couponAply').show();

                    }


                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  
                }
            })
        }

        function couponCalculationFix() {

            $.ajax({
                type: 'GET',
                url: "/guest/coupon-calculation",
                dataType: 'json',
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Sub Total + PPN </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end" id="result-subtotal">Rp. ${parseInt(data.total).toLocaleString()}</h4>
                                </td>
                            </tr>`
                        )
                    } else {
                        $('#couponCalField').html(
                            `

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon Name</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">${data.coupon_name}</h6>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon Discount</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end" id="price-discount">${parseInt(data.discount_amount).toLocaleString()}</h4>
                                </td>
                            </tr>

                            `
                        )
                    }
                }
            })
        }

        couponCalculationFix();
    </script>


</body>

</html>
