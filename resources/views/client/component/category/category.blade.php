@extends('client.layout.app')
@section('content')
@push("css")
<link href="{{asset('client_assets/css/full-width-menu.css')}}" rel="stylesheet" type="text/css">
@endpush
<div class="position-relative" style="">
    @include('client.component.global.top_menu')

    <div id="carousel-menu-binding" style="top:0">
        <div id="carousel-area" class="owl-carousel d-block">

        </div>
    </div>
</div>



<div id="from-top">
    <div id="dynamic-category">

    </div>
</div>


@include('client.layout.sidebar')
@include('client.component.global.search')
@include('client.component.category.script')
@endsection
