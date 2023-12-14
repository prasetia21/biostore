@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tambah Permission </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Tambah Permission </li>
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

		<form id="myForm" method="post" action="{{ route('store.permission') }}"  >
			@csrf
		 
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Nama Permission</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="name" class="form-control"   />
				</div>
			</div> 


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Nama Grup</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<select name="group_name" class="form-select mb-3" aria-label="Default select example">
					<option selected="">Pilih Grup Permission</option>
					<option value="brand">Brand</option>
					<option value="category">Kategori</option>
					<option value="subcategory">Sub-Kategori</option>
					<option value="product">Produk</option>
					<option value="slider">Slider</option>
					<option value="ads">Iklan</option>
					<option value="coupon">Voucher</option>
					<option value="area">Area</option>
					<!-- <option value="vendor">Vendor</option> -->
					<option value="order">Order</option>
					<option value="return">Pengembalian</option>
					<option value="report">Laporan</option>
					<option value="user">Managemen User</option>
					<option value="review">Review</option>
					<option value="setting">Setting</option>
					<option value="blog">Blog</option>
					<option value="role">Role</option>
					<option value="admin">Admin</option>
					<option value="stock">Stok</option>
				</select>
				</div>
			</div> 

			


			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="btn btn-primary px-4" value="Simpan Perubahan" />
				</div>
			</div>
		</div>

		</form>



	</div>
	 



							</div>
						</div>
					</div>
				</div>
			</div>




<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
            },
            messages :{
                name: {
                    required : 'Masukkan Nama Permission',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>



 


@endsection