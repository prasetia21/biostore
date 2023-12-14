<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashobard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.brand') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Brand</a>
                </li>

                <li> <a href="{{ route('add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Brand </a>
                </li>

            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Kategori</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Category</a>
                </li>

                <li> <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Kategori</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-codepen"></i>
                </div>
                <div class="menu-title">Sub-Kategori</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Lihat
                        Sub-Kategori</a>
                </li>

                <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Tambah
                        Sub-Kategori</a>
                </li>


            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Pilihan Warna</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.color') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Warna Produk</a>
                </li>

                <li> <a href="{{ route('add.color') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Warna
                        Produk</a>
                </li>


            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-fresh-juice"></i>
                </div>
                <div class="menu-title">Produk</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Produk</a>
                </li>
                <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Produk</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-cart-full"></i>
                </div>
                <div class="menu-title">Stok</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Stok Produk</a>
                </li>
            </ul>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-invention"></i>
                </div>
                <div class="menu-title">Coupon</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Coupon</a>
                </li>

                <li> <a href="{{ route('add.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Coupon</a>
                </li>


            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-invention"></i>
                </div>
                <div class="menu-title">Voucher</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.voucher') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Voucher</a>
                </li>

                <li> <a href="{{ route('add.voucher') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Voucher</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-fresh-juice"></i>
                </div>
                <div class="menu-title">Reward</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.reward') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Reward</a>
                </li>
                <li> <a href="{{ route('add.reward') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Reward</a>
                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-map"></i>
                </div>
                <div class="menu-title">Alamat Pengiriman</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.province') }}"><i class="bx bx-right-arrow-alt"></i>Provinsi</a>
                </li>
                <li> <a href="{{ route('all.regency') }}"><i class="bx bx-right-arrow-alt"></i>Kota</a>
                </li>
                <li> <a href="{{ route('all.district') }}"><i class="bx bx-right-arrow-alt"></i>Distrik</a>
                </li>
            </ul>
        </li>




        <li class="menu-label">Transaksi</li>

        <!-- <li>
     <a href="javascript:;" class="has-arrow">
      <div class="parent-icon"><i class='lni lni-network'></i>
      </div>
      <div class="menu-title">Vendor Manage </div>
     </a>
     <ul>
      {{-- <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a> --}}
      </li>
      {{-- <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a> --}}
      </li>
      
     </ul>
    </li> -->



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Order</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending</a>
                </li>
                <li> <a href="{{ route('admin.confirmed.order') }}"><i
                            class="bx bx-right-arrow-alt"></i>Konfirmasi</a>
                </li>
                <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Proses</a>
                </li>
                <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Terkirim</a>
                </li>



            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='lni lni-paperclip'></i>
                </div>
                <div class="menu-title">Return Order </div>
            </a>
            <ul>
                <li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
                </li>
                <li> <a href="{{ route('complete.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Complete
                        Request</a>
                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-stats-up"></i>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                <li> <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Laporan</a>
                </li>

                <li> <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order Pembeli</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-indent-increase"></i>
                </div>
                <div class="menu-title">Review</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
                </li>

                <li> <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish Review</a>
                </li>


            </ul>
        </li>



        <li class="menu-label">Setting Aplikasi</li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-pyramids"></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>Lihat
                        Kategori</a>
                </li>

                <li> <a href="{{ route('admin.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Post</a>
                </li>


            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-gallery"></i>
                </div>
                <div class="menu-title">Slider</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Slider</a>
                </li>


                <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Slider</a>
                </li>


            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-image"></i>
                </div>
                <div class="menu-title">Banner</div>
            </a>
            <ul>

                <li> <a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Banner</a>
                </li>


                <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Banner</a>
                </li>

            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-cog"></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
            <ul>
                <li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
                </li>

                <li> <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
                </li>


            </ul>
        </li>




        </li>

        <li class="menu-label">Managemen User</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-slideshare"></i>
                </div>
                <div class="menu-title">User</div>
            </a>
            <ul>
                <li> <a href="{{ route('all-user') }}"><i class="bx bx-right-arrow-alt"></i>User</a>
                </li>

                {{-- <!-- <li> <a href="{{ route('all-vendor') }}"><i class="bx bx-right-arrow-alt"></i>Vendor</a> --}}
                {{-- </li> --}}


            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">Role & Permission</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>Permission</a>
                </li>
                <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a>
                </li>

                <li> <a href="{{ route('add.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Roles in
                        Permission</a>
                </li>

                <li> <a href="{{ route('all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Roles
                        in Permission</a>
                </li>

            </ul>
        </li>


        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-user"></i>
                </div>
                <div class="menu-title">Managemen Admin </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>Lihat Admin</a>
                </li>
                <li> <a href="{{ route('add.admin') }}"><i class="bx bx-right-arrow-alt"></i>Tambah Admin</a>
                </li>


            </ul>
        </li>



        <!-- <li>
     <a href=" " target="_blank">
      <div class="parent-icon"><i class="bx bx-support"></i>
      </div>
      <div class="menu-title">Bantuan</div>
     </a>
    </li> -->
    </ul>
    <!--end navigation-->
</div>
