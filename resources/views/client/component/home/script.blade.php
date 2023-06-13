<script>
    client.get('{{route('home.load.first')}}')
    .then(function (response){
        if(response.status === 200){
            let data = response.data;
            // let menu = data.menu;
            let feature = data.feature;
            let home_categories = data.home_categories;

            let feature_el = $('#carousel-area');
            feature_el.empty();
            feature.forEach(function(item){
                FeatureItem(feature_el, item)
            })
            $("#carousel-area").owlCarousel({
                items: 1,
                autoPlay: true
            });

            //home categories
            let home_cat_el =$('#dynamic-home-category');
            home_cat_el.empty();
            home_categories.forEach(function (item){
                HomeCatItem(home_cat_el, item)
            })


        }
    })
    .catch(function (error){

    })

    function FeatureItem(el, item){
        let redirect_to_play = "{{route('client.movie')}}/"+item.name;
        el.prepend(`
            <div class="feature-carousel-item ">
                <div style="opacity: .6;width: 100vw;height: 650px;" class="bg-white <!--position-absolute-->">
                    <img src="${item.banner}" style="height: 100%;object-fit: cover;width: 100%"  class="img-fluid">
                     <div class="carousel-gradient top-0"></div>
                </div>
                <div class="container-lg  ">
                    <div class="feature-item-content">
                        <div class="container-lg">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="rating fw-500">
                                        <span class="imdb me-2">IMDB</span> ${item.imdb != "" ? item.imdb : "-" }
                                    </div>
                                    <p class="pt-4 m-0">2019 - Drama Returning Series</p>
                                    <p class="streaming pt-4 ">STREAMING NOW</p>
                                    <p class="feature-movie-name text-uppercase">${item.display_name}</p>
                                    <div>${item.description}</div>
                                    <a href="${redirect_to_play}" class="btn mt-2 btn-highlight text-uppercase">
                                        <i class="bi bi-play-circle me-2"></i>
                                        Watch Now
                                    </a>
                                </div>
                                <div class="col-5 ps-3 d-lg-block d-none">
                                    <div class="d-flex align-items-end" style="height: 100%">
                                        <div class="d-flex w-100 align-items-center">
                                            <img src="client_assets/img/Base.png" style="object-fit: cover; height: 320px; width: 240px">
                                            <div class="play-next rounded-end">
                                                <p class="mb-1 f-14 " style="opacity: 0.8">Play Next</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="fw-bold m-0 pe-2 py-1">KAISER <br> STREAMING NOW</h6>
                                                    <a class="play-next-btn" href="#">
                                                        <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                </div>
                                                <p class="m-0 mt-1 f-14" style="opacity: 0.7">90 min</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `)
    }

    function HomeCatItem(el, item){
        let template = `
        <div class="home-categories">
            <div class="container-lg overflow-hidden">
                <h4 class="text-uppercase mb-4 card-title">${item.display_name}</h4>

                <div class="owl-carousel" id="${item.name}">
        `;

        item.movies.forEach(function(movie){
            let redirect_to_play = "{{route('client.movie')}}/"+movie.name;
            template += `
                    <a href="${redirect_to_play}" class="home-categories-item">
                        <div class="home-categories-image rounded-2 overflow-hidden" >
                            <img src="${movie.thumbnail}" class="img-fluidd" style="object-fit: cover; min-height: 200px;">
                        </div>
                        <h5 class="mt-2 mb-2">${movie.display_name}</h5>
                        <p class="mb-1">2022</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rating">
                                <span class="imdb me-2">IMDB</span>
                                <span class="color-rating">${movie.imdb}</span>
                            </div>
                            <div class="d-flex">
                                <button class="btn me-2 btn-icon">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button movie-name="${movie.name}" class="btn favourite-btn btn-icon">
                                    <i  class="bi bi-heart ${movie.favourite == 'true' ? 'text-warning' : ''}"></i>
                                </button>
                            </div>
                        </div>

                        <div class="play-mode-banner">${movie.play_mode}</div>
                    </a>
            `
        });

        template += `
                </div>
            </div>
        </div>
        `;

        el.append(template);


        $('#'+item.name).owlCarousel({
            items: 6,
            // stagePadding: '5px',
            autoWidth: false,
            nav: true,
            navText: [`<i class="bi bi-chevron-compact-left"></i>`,`<i class="bi bi-chevron-compact-right"></i>`],
            navElement: 'div',
            dots: true,
            autoplay: false,
            autoplayHoverPause: true,
            responsive:{
                0 : {
                    items: 1
                },
                // breakpoint from 480 up
                480 : {
                    items: 2
                },
                // breakpoint from 768 up
                768 : {
                    items: 3
                },
                992 : {
                    items: 4
                },
                1200 : {
                    items: 5
                }

            }
        })

    }

    $('#dynamic-home-category').on('click', '.favourite-btn', AddOrRemoveFavourite);


    async function AddOrRemoveFavourite(){
        let movie_name = $(this).attr('movie-name');

        let icon = "";
        let redirect_to_login = false;
        if(movie_name == ""){
            console.log('movie name can not found');
        }
        else{
            let form_data = new FormData();
            form_data.append('movie_name', movie_name)
            await client.post('/add-or-remove-to-favourite', form_data)
            .then(function (response){
                if(response.status === 200){
                    let data = response.data;
                    icon = data.icon;
                    redirect_to_login = data.redirect_to_login;
                }
            })
            .catch(function (error){
                console.log(error)
            })
        }


        if(redirect_to_login == true){
            window.location.href = home_url+"/account";
        }

        if(icon == "add"){
            $(this).children().first().addClass('text-warning');
        }
        else if(icon == "remove"){
            $(this).children().first().removeClass('text-warning');
        }

    }

</script>
