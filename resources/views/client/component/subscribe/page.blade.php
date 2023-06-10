@extends('client.layout.app')
@section('content')
    @include('client.component.global.top_menu')
    <div class="home-categories mt-3 mb-3 broadcump-banner d-flex justify-content-center align-items-center" >
        <h3 class="m-0 text-center">
            Choose A Plan And <br>
            Enjoy all BongTV Premium Contents
        </h3>
    </div>
    <div class="container-lg mb-5">
        <div class="row" id="subscribe-item-container">

        </div>
    </div>
    @include('client.component.subscribe.payment_method')
    @include('client.component.global.footer')
    @include('client.layout.sidebar')
    @include('client.component.global.search')
    @include('client.component.subscribe.script')
@endsection

