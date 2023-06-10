<!--    Search Modal-->
<div class="modal" id="search-modal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="logo" style="width: 15%">
                    <h2 class="m-0 text-uppercase"><span class="text-dark">Bong</span><span style="color: var(--font-highlight)">TV</span></h2>
                </div>
                <form action="" class="d-flex justify-content-center align-items-center" id="search-form" style="width: 75%">
                    <input type="text" id="movie" name="movie" class="form-control w-100 rounded-0 me-2">
                    <button type="submit" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                </form>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="width: 10%"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="movies-list container-lg">
                    <div style="margin-top: 20px;">
                        <h5 class="text-dark" style="margin-bottom: -8px;">Search Result</h5>
                        <hr style="color: black;width: 14%;">
                    </div>
                    <div class="row" id="search-item">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#search-form').on('submit', function (e){
        e.preventDefault();
        let data = $(this).serialize();
        console.log(data)
        client.get('/search?'+data)
        .then(function (response){
            if(response.status === 200){
                let data = response.data;
                let el = $('#search-item');
                el.empty();
                if(data.length > 0){
                    data.forEach(function(movie){
                        SearchTemplate(el, movie)
                    })
                }
                else{

                }
            }
        })
        .catch(function (error){
            console.log(error);
        })
    })


    function SearchTemplate(el, item){
        el.append(`
            <div class="col-3 pt-2 pb-2">
                <div class="search-item position-relative">
                    <div class="home-categories-image rounded-2 overflow-hidden">
                        <img src="${item.thumbnail}" class="img-fluid w-100" >
                    </div>
                    <div class="custom-show-detail">
                        <div class="custom-info"><span class="title">${item.display_name}</span></div>
                        <div class="custom-features d-none">
                            <div class="gradient-buttons">
                                <div class="cta customWatchNow " style="background: linear-gradient(301deg, rgb(249, 159, 0), rgb(255, 0, 85));" href="/bn/series/overtrump-crime-comedy">
                                    দেখুন
                                </div>
                            </div>
                            <div class="custom-icons">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `)
    }
</script>
