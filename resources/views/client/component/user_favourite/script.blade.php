<script>
    client.post('/user-favourite')
    .then(function (response){
        if(response.status === 200){
            let data = response.data;
            let el = $('#my-favourite')
            if(data.length > 0){
                data.forEach(function (item){
                    MyFavourite(el, item);
                })
            }
            else{
                el.append(`
                    <div class="card mt-3 ">
                        <div class="card-body">
                            <h5 class="text-center text-dark">No data found!</h5>
                        </div>
                    </div>
                `)
            }
        }
    })
    .catch(function (error){
        console.log(error)
        if(error.response){
            let response = error.response;
            if(response.status === 401){
                redirectToLogin();
            }
        }
    })


    function MyFavourite(el, item){
        el.append(`
                <div class="col-4 pt-3 pb-3">
                    <a href="https://google.com" class="favourite-item rounded-3 p-2 d-flex">
                        <div movie-name="${item.name}" class="favourite-close favourite-btn"><i class="bi bi-x-octagon"></i></div>
                        <div class="rounded-3 overflow-hidden" >
                            <img src="${item.thumbnail}" style="height: 80px;width: 100%;object-fit: cover">
                        </div>
                        <div class="ps-3 pe-3">
                            <h5 class="mt-3 mb-2 text-truncate text-dark">${item.display_name}</h5>
                            <p class="mb-1 text-dark">${item.length} min</p>
                        </div>
                        <div class="d-none text-center loading-btn top-0 position-absolute h-100 w-100 d-flex justify-content-center align-items-center" onclick="" style="background: #c7c6c6;left: 0;">loading</div>
                    </a>
                </div>
        `)
    }



    $('#my-favourite').on('click', '.favourite-btn', AddOrRemoveFavourite);
    $('#my-favourite').on('click', '.loading-btn', function (e){
        e.stopPropagation();
        e.preventDefault();
    });


    async function AddOrRemoveFavourite(e){
        e.stopPropagation();
        e.preventDefault();
        let parent = $(this).parent();
        let loading =  parent.children().last();
        $(this).addClass('d-none')
        loading.removeClass('d-none')
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
            parent.parent().remove();
        }
        else{
            $(this).removeClass('d-none')
            loading.addClass('d-none')
        }

    }

</script>
