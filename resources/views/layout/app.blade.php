<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset("assets/img/favicon.png")}}" rel="icon">
    <link href="{{asset("assets/img/apple-touch-icon.png")}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset("assets/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/quill/quill.snow.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/quill/quill.bubble.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/remixicon/remixicon.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/simple-datatables/style.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
{{--    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />--}}
    <link href="{{asset("assets/vendor/quill/quill.snow.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/quill/quill.bubble.css")}}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <link href="{{asset("assets/css/style.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/admin.css")}}" rel="stylesheet">
    <!-- Progress Bar Css -->
    <style>
        .progress-bar3 {
            height: 3px;
            border-radius: 4px;
            background-image: linear-gradient(to right, #2bcc9e, #5ac8fa, #007aff, #7dc8e8, #5856d6, #ff2d55);
            transition: 0.4s linear;
            transition-property: width, background-color;
        }
        .progress-infinite .progress-bar3 {
            width: 100%;
            background-image: linear-gradient(to right, #2bcc9e, #5ac8fa, #007aff, #7dc8e8, #5856d6, #ff2d55);
            animation: colorAnimation 1s infinite;
        }
        @keyframes colorAnimation {
            0% {
                background-image: linear-gradient(to right, #2bcc9e, #5ac8fa, #007aff, #7dc8e8, #5856d6, #ff2d55);
            }
            20% {
                background-image: linear-gradient(to right, #5ac8fa, #007aff, #7dc8e8, #5856d6, #ff2d55, #2bcc9e);
            }
            40% {
                background-image: linear-gradient(to right, #007aff, #7dc8e8, #5856d6, #ff2d55, #2bcc9e, #5ac8fa);
            }
            60% {
                background-image: linear-gradient(to right, #7dc8e8, #5856d6, #ff2d55, #2bcc9e, #5ac8fa, #007aff);
            }
            100% {
                background-image: linear-gradient(to right, #5856d6, #ff2d55, #2bcc9e, #5ac8fa, #007aff, #7dc8e8);
            }
        }
    </style>

    @hasSection('no-sidebar')
        <style>
            #main{
                margin: 0;
            }
            @media (min-width: 1200px) {
                #main,
                #footer {
                    margin-left: 0px!important;
                }
            }
            @media (max-width: 1199px) {
                .sidebar {
                    left: 0px;
                }
            }
        </style>
    @endif
{{--    <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" integrity="sha512-LUKzDoJKOLqnxGWWIBM4lzRBlxcva2ZTztO8bTcWPmDSpkErWx0bSP4pdsjNH8kiHAUPaT06UXcb+vOEZH+HpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset("assets/vendor/quill/quill.min.js")}}"></script>
    <script src="{{asset("/assets/js/helper.js")}}"></script>
</head>

<body>
<!-- ======= Header ======= -->
@hasSection('no-sidebar')
@else
    <!-- End Header -->
    @include('layout.header')
@endif

<!-- ======= Sidebar ======= -->
@hasSection('no-sidebar')
@else
    <!-- End Header -->
    @include('layout.sidebar')
@endif
<!-- End Sidebar-->

<main id="main" class="main">
    <!-- End Page Title -->
    @yield('broadcumb')
    <!-- End Page Title -->

    <section class="section dashboard">
        @yield('main-content')
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
@hasSection('no-sidebar')

@else
    <!-- End Header -->
    @include('layout.footer')
@endif

<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset("assets/vendor/apexcharts/apexcharts.min.js")}}"></script>
<script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/vendor/chart.js/chart.umd.js")}}"></script>
<script src="{{asset("assets/vendor/echarts/echarts.min.js")}}"></script>

<script src="{{asset("assets/vendor/simple-datatables/simple-datatables.js")}}"></script>
<script src="{{asset("assets/vendor/tinymce/tinymce.min.js")}}"></script>
<script src="{{asset("assets/vendor/php-email-form/validate.js")}}"></script>

<!-- Template Main JS File -->
<script src="{{asset("assets/js/main.js")}}"></script>

</body>

</html>
