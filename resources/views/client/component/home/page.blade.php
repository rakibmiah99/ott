@extends('client.layout.app')
@section('content')
<div class="position-relative" style="">
    @include('client.component.global.top_menu')
    @include('client.component.home.feature')
</div>

<div id="from-top">
    <div id="dynamic-home-category">
        <!--Dynamic Menu From script.blade.php-->
    </div>

    <!-- Based On Watch -->
    <div class="home-categories">
        <div class="container-lg overflow-hidden">
            <h4 class="text-uppercase mb-4 mb-4 card-title">Based On Watch</h4>
            <div class="owl-carousel" id="based-on-watch">

                <a href="#" class="me-3 text-white">
                    <div class="position-relative">
                        <div class="position-relative">
                            <img src="client_assets/img/watch.png" class="based-on-image">
                            <div class="position-absolute _overlay d-flex flex-column justify-content-between p-3">
                                <div class="top">
                                    <button class="btn btn-highlight rounded-pill">Fantasy</button>
                                </div>
                                <div class="bottom">
                                    <div class="movie-info f-14 d-flex">
                                        <span class="hour me-4">
                                            <i class="bi bi-clock me-2"></i>
                                            <span>1hr 40 Mins</span>
                                        </span>
                                        <span class="hour me-4">
                                            <i class="bi bi-eye me-2"></i>
                                            <span>21.3K views</span>
                                        </span>
                                    </div>
                                    <h3 class="mt-2">WEIGHTLIFTING</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="me-3 text-white">
                    <div class="position-relative">
                        <div class="position-relative">
                            <img src="client_assets/img/sahos.png" class="based-on-image">
                            <div class="position-absolute _overlay d-flex flex-column justify-content-between p-3">
                                <div class="top">
                                    <button class="btn btn-highlight rounded-pill">Fantasy</button>
                                </div>
                                <div class="bottom">
                                    <div class="movie-info f-14 d-flex">
                                        <span class="hour me-4">
                                            <i class="bi bi-clock me-2"></i>
                                            <span>1hr 40 Mins</span>
                                        </span>
                                        <span class="hour me-4">
                                            <i class="bi bi-eye me-2"></i>
                                            <span>21.3K views</span>
                                        </span>
                                    </div>
                                    <h3 class="mt-2">WEIGHTLIFTING</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="me-3 text-white">
                    <div class="position-relative">
                        <div class="position-relative">
                            <img src="client_assets/img/watch.png" class="based-on-image">
                            <div class="position-absolute _overlay d-flex flex-column justify-content-between p-3">
                                <div class="top">
                                    <button class="btn btn-highlight rounded-pill">Fantasy</button>
                                </div>
                                <div class="bottom">
                                    <div class="movie-info f-14 d-flex">
                                        <span class="hour me-4">
                                            <i class="bi bi-clock me-2"></i>
                                            <span>1hr 40 Mins</span>
                                        </span>
                                        <span class="hour me-4">
                                            <i class="bi bi-eye me-2"></i>
                                            <span>21.3K views</span>
                                        </span>
                                    </div>
                                    <h3 class="mt-2">WEIGHTLIFTING</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>

    @include('client.component.global.footer')
</div>
@include('client.layout.sidebar')
@include('client.component.global.search')
@include('client.component.home.script')
@endsection
