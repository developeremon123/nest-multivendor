@extends('frontend.layouts.master')
@section('title')
    Easy Online Shop
@endsection
@section('content')
    @include('frontend.layouts.home-slider')
    <!--End hero slider-->
    @include('frontend.layouts.popular-categories')
    <!--End category slider-->
    @include('frontend.layouts.banners')
    <!--End banners-->
    @include('frontend.layouts.new-products')
    <!--Products Tabs-->
    @include('frontend.layouts.featured-products')
    <!--End Best Sales-->
    <!-- fashion Category -->
    @include('frontend.layouts.fashion-category')
    <!--End fashion Category -->
    <!-- Tshirt Category -->
    @include('frontend.layouts.sweet-home-category')
    <!--End Tshirt Category -->
    <!-- Computer Category -->
    @include('frontend.layouts.computer-category')
    <!--End Computer Category -->
    @include('frontend.layouts.hot-deals')
    <!--End 4 columns-->
    <!--Vendor List -->
    @include('frontend.layouts.vendor-list')
    <!--End Vendor List -->
@endsection
