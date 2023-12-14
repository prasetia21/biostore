@extends('frontend.master_dashboard')
@section('main')

@section('title')
    Biovarnish Store
@endsection

@include('frontend.home.home_slider')

<!--End hero slider-->
@include('frontend.home.home_features_category')

<!--End category slider-->

@include('frontend.home.home_features_reward')

@include('frontend.home.home_new_product')

<!--Products Tabs-->

@endsection
