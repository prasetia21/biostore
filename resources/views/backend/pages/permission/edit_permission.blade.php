@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit Permission </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Permission </li>
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

		<form id="myForm" method="post" action="{{ route('update.permission') }}"  >
			@csrf
		 <input type="hidden" name="id" value="{{ $permission->id }}">
		 
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Permission Name</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="name" class="form-control" value="{{ $permission->name }}"   />
				</div>
			</div> 


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Nama Grup</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<select name="group_name" class="form-select mb-3" aria-label="Default select example">
	<option selected="">Pilih Grup Permission</option>
	<option value="brand" {{ $permission->group_name == 'brand' ? 'selected': ''}}>Brand</option>
	<option value="category"{{ $permission->group_name == 'category' ? 'selected': ''}}>Kategori</option>
	<option value="subcategory"{{ $permission->group_name == 'subcategory' ? 'selected': ''}}>Sub-Kategori</option>
	<option value="product"{{ $permission->group_name == 'product' ? 'selected': ''}}>Produk</option>
	<option value="slider"{{ $permission->group_name == 'slider' ? 'selected': ''}}>Slider</option>
	<option value="ads"{{ $permission->group_name == 'ads' ? 'selected': ''}}>Iklan</option>
	<option value="coupon"{{ $permission->group_name == 'coupon' ? 'selected': ''}}>Voucher</option>
	<option value="area"{{ $permission->group_name == 'area' ? 'selected': ''}}>Area</option>
	<option value="vendor"{{ $permission->group_name == 'vendor' ? 'selected': ''}}>Vendor</option>
	<option value="order"{{ $permission->group_name == 'order' ? 'selected': ''}}>Order</option>
	<option value="return"{{ $permission->group_name == 'return' ? 'selected': ''}}>Pengembalian</option>
	<option value="report"{{ $permission->group_name == 'report' ? 'selected': ''}}>Laporan</option>
	<option value="user"{{ $permission->group_name == 'user' ? 'selected': ''}}>Managemen User</option>
	<option value="review"{{ $permission->group_name == 'review' ? 'selected': ''}}>Review</option>
	<option value="setting"{{ $permission->group_name == 'setting' ? 'selected': ''}}>Setting</option>
	<option value="blog"{{ $permission->group_name == 'blog' ? 'selected': ''}}>Blog</option>
	<option value="role"{{ $permission->group_name == 'role' ? 'selected': ''}}>Role</option>
	<option value="admin"{{ $permission->group_name == 'admin' ? 'selected': ''}}>Admin</option>
	<option value="stock"{{ $permission->group_name == 'stock' ? 'selected': ''}}>Stok</option>
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