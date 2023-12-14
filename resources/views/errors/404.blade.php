@extends('frontend.master_dashboard')
@section('main')

@section('title')
   404 Page 
@endsection


<div class="page-content pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
                        <p><img src="{{ asset('frontend/assets/imgs/page/page-404.png') }}" style="width:404px;" alt="" class="hover-up" /></p>
                        <h1 class="display-2 mb-30">Page Not Found</h1>
                        <p class="font-lg text-grey-700 mb-30">
                            Link yang Anda tuju tidak ditemukan, mungkin ada kesalahan dalam penulisan URL atau Halaman tidak tersedia<br />
                            kunjungi <a href="{{ url('/') }}"> <span> Halaman Awal</span></a>
                        </p>
                        <div class="search-form">
                             
                        </div>
                        <a class="btn btn-default submit-auto-width font-xs hover-up mt-30" href="{{ url('/') }}"><i class="fi-rs-home mr-5"></i> Kembali ke Halaman Home</a>
                    </div>
                </div>
            </div>
        </div>





@endsection