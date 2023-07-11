<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <!--    <link rel="stylesheet" href="assets/css/bootstrap-icon.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="{{asset('client_assets/css/bootstrap5.min.css')}}" rel="stylesheet">
    <link href="{{asset('client_assets/css/utility.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('client_assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('client_assets/css/from-template.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('client_assets/css/jibon.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('client_assets/css/responsive.css')}}" rel="stylesheet" type="text/css">
    @stack('css')

    {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" integrity="sha512-LUKzDoJKOLqnxGWWIBM4lzRBlxcva2ZTztO8bTcWPmDSpkErWx0bSP4pdsjNH8kiHAUPaT06UXcb+vOEZH+HpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('client_assets/js/config.js')}}"></script>
    <title>Bong TV</title>
    <style>

    </style>
</head>

<body>
    @yield('content')
    <script>
        $(document).ready(function() {

            $('#carousel-must-watch').owlCarousel({
                items: 6,
                // stagePadding: '5px',
                autoWidth: false,
                nav: true,
                navText: [`<i class="bi bi-chevron-compact-left"></i>`, `<i class="bi bi-chevron-compact-right"></i>`],
                navElement: 'div',
                dots: true,
                autoplay: false,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    // breakpoint from 480 up
                    480: {
                        items: 2
                    },
                    // breakpoint from 768 up
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 5
                    }

                }
            })


            $("#based-on-watch").owlCarousel({
                responsive: {
                    0: {
                        items: 1
                    },
                    // breakpoint from 480 up
                    480: {
                        items: 2
                    },
                    // breakpoint from 768 up
                    768: {
                        items: 3
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    }

                }
            });

        });


        <!--responsive js-->
        $(window).on('scroll', function() {
            let top = window.scrollY;
            if (top > 200) {
                $('#top-menu').css({
                    'position': 'fixed',
                    'top': '-50px',
                    'padding': 0,
                    'background': 'white',
                    'width': '100%'
                })
                $('#top-menu').removeClass('container-lg')


                if (window.matchMedia('(min-width: 1200px)').matches == true) {

                } else {
                    //...
                    console.log('hi')
                }
            } else {
                $('#top-menu').removeAttr('style')
                $('#top-menu').addClass('container-lg')
            }
        })
    </script>
</body>

</html>
