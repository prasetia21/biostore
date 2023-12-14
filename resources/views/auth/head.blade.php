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

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/new/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/media-query.css') }}" />

    <!-- Toaster --> 
   
 <!-- Toaster   -->


    {{-- <script src="https://js.stripe.com/v3/"></script> --}}

</head>