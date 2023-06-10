@extends('client.layout.app')
@section('content')
    @include('client.component.global.top_menu')
    <div class="home-categories mt-5 mb-5">
        <div class="container-lg overflow-hidden">
            <h4 class="text-uppercase card-title">My Favourite</h4>
            <div class="row" id="my-favourite">

            </div>

        </div>
    </div>
    @include('client.component.global.footer')
    @include('client.layout.sidebar')
    @include('client.component.global.search')
    @include('client.component.user_favourite.script')
@endsection

