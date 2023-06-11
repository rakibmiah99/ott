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
            <h4 class="text-uppercase mb-4 card-title">Based On Watch</h4>
            <div class="owl-carousel owl-loaded owl-drag" id="based-on-watch">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        <div class="owl-item">
                            <a href="#" class="text-white">
                                <div class="">
                                    <img src="client_assets/img/watch.png" class="based-on-image">
                                    <div class="d-flex flex-column justify-content-between p-3">
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
                            </a>

                        </div>
                        <div class="owl-item">
                            <a href="#" class="text-white">
                                <div class="">
                                    <img src="client_assets/img/watch.png" class="based-on-image">
                                    <div class="d-flex flex-column justify-content-between p-3">
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
                            </a>

                        </div>
                        <div class="owl-item">
                            <a href="#" class="text-white">
                                <div class="">
                                    <img src="client_assets/img/watch.png" class="based-on-image">
                                    <div class="d-flex flex-column justify-content-between p-3">
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
                            </a>

                        </div>
                        <div class="owl-item">
                            <a href="#" class="text-white">
                                <div class="">
                                    <img src="client_assets/img/watch.png" class="based-on-image">
                                    <div class="d-flex flex-column justify-content-between p-3">
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
                            </a>

                        </div>
                        <div class="owl-item">
                            <a href="#" class="text-white">
                                <div class="">
                                    <img src="client_assets/img/watch.png" class="based-on-image">
                                    <div class="d-flex flex-column justify-content-between p-3">
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
                            </a>

                        </div>
                    </div>
                </div>
                <div class="owl-nav">
                    <div class="owl-prev">
                        <i class="bi bi-chevron-compact-left"></i>
                    </div>
                    <div class="owl-next disabled">
                        <i class="bi bi-chevron-compact-right"></i>
                    </div>
                </div>
                <div class="owl-dots">
                    <button role="button" class="owl-dot"> <span></span></button>
                    <button role="button" class="owl-dot active"> <span></span></button>
                </div>
            </div>
        </div>
    </div>

    @include('client.component.global.footer')
</div>
@include('client.layout.sidebar')
@include('client.component.global.search')
@include('client.component.home.script')
@endsection