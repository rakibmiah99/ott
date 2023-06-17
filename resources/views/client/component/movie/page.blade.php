@extends('client.layout.app')
@push("css")
<link href="{{asset('client_assets/css/full-width-menu.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('content')
@include('client.component.global.top_menu')
<div>
    <div class="movie_image_1">
        <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/19/1681926242070_3840x1080_32x9Images.jpg?impolicy=resize&w=1366&h=384.1875" class="w-100">
    </div>
</div>
<div class="home-categories" style="padding-top: 10px; padding-bottom: 10px">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-end movies-info">
            <h3>UNISH 20</h3>
            <h6 class="ms-3">Length 114min | Romantic | 9.4</h6>
        </div>
        <div class="share">
            <a href="#" class="share-link">
                <i class="bx bi-facebook share-icon"></i>
            </a>
            <a href="#" class="share-link">
                <i class="bx bi-twitter share-icon"></i>
            </a>
            <a href="#" class="share-link">
                <i class="bx bi-envelope share-icon"></i>
            </a>
        </div>
    </div>

    <hr>
    <div class="row mt-3">
        <div class="col-md-6">
            <p><b>Director :</b> শিহাব শাহীন</p>
            <p> <b>অভিনয়ে :</b>
                নাসির উদ্দিন খান, রাফিয়াথ রশিদ মিথিলা, সুমন আনোয়ার, ফরহাদ লিমন, আব্দুল্লাহ আল সেন্টু, রফিউল কাদের রুবেল, অর্ণব ত্রিপুরা, মিশকাত মাহমুদ, আইমন শিমলা, জাহিদ ইসলাম, সাজু মাহাদি</p>
            <p>২০১৮ সাল, কক্সবাজার। সরকারের মাদকবিরোধী অভিযান চলছে জোরেশোরে। হঠাৎ চারদিকে খবর ছড়িয়ে পড়ে, কুখ্যাত মাদক ব্যবসায়ী অ্যালেন স্বপন ক্রসফায়ারে মারা গেছে। একই সময় প্রায় একই রকম দেখতে একজন, শামসুর রহমান আবির্ভূত হয় ঢাকা শহরে। কে এই শামসুর রহমান?</p>
        </div>
        <div class="col-md-6 d-md-block d-none">
            <div class=" d-xl-flex">
                <div class="thumbnail me-2 w-100">
                    <div class="image position-relative d-flex justify-content-center align-items-center">
                        <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=200&h=121" style="width: 100%;height: 150px;opacity: 0.6" ;>
                        <i class="bx bi-lock text-danger position-absolute" style="font-size: 50px"></i>
                    </div>
                    <button class="btn btn-danger rounded-0 w-100">Locked</button>
                </div>
                <div class="episode-description">
                    <h2>Season 1 : E-01</h2>
                    <h3 class="">মাইশেলফ অ্যালেন স্বপন পর্ব ০১</h3>
                    <p>
                        কক্সবাজার শহরে খবর ছড়িয়ে পড়ে পুলিশের অভিযানে ক্রসফায়ারে মারা গেছে অ্যালেন স্বপন। ঢাকায় শামসুর রহমানের দরজায় কড়া নাড়ে প্রায় একই রকম দেখতে একজন। দরজা খোলে শামসুরের স্ত্রী শায়লা।
                    </p>
                </div>
            </div>
        </div>
    </div>
    <h4 class="text-danger">Episodes</h4>
    <hr>
    <div class="more-episode">
        <div class="owl-carousel" id="carousel-must-watch">
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 1</h5>
            </div>
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 2</h5>
            </div>
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 3</h5>
            </div>
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 4</h5>
            </div>
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 5</h5>
            </div>
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 6</h5>
            </div>
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 7</h5>
            </div>
            <div class="home-categories-item">
                <div class="home-categories-image rounded-2 overflow-hidden">
                    <img src="https://snagfilms-a.akamaihd.net/dd078ff5-b16e-45e4-9723-501b56b9df0a/images/2023/04/21/1682065562556_as_episode01_16x9Images.jpg?impolicy=resize&w=333.33333333333337&h=187.50000000000003" class="img-fluid">
                </div>
                <h5 class="mt-2 mb-2">Episode 8</h5>
            </div>
        </div>
    </div>

</div>
@include('client.component.global.footer')
@include('client.layout.sidebar')
@include('client.component.global.search')
@include('client.component.movie.script')
@endsection
