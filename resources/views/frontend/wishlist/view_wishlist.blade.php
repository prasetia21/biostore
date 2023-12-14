@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Wishlist
@endsection

    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Wishlist
        </div>
    </div>
</div>

<div class="container mb-50 mt-20">
    <div class="row">
        <div class="col-md-12 m-auto">
            <div class="mb-20">
                <h1 class="heading-2 mb-10">Daftar Keinginan</h1>
                <h6 class="text-body">List Produk...</h6>
            </div>
            <div class="table-responsive shopping-summery">
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                            </th>
                            <th scope="col" colspan="2">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stock</th>

                            <th scope="col" class="end">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="wishlist">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
