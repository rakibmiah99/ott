<!--    Search Modal-->
<div class="modal" id="search-modal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="logo" style="width: 15%">
                    <h2 class="m-0 text-uppercase"><span class="text-dark">Bong</span><span style="color: var(--font-highlight)">TV</span></h2>
                </div>
                <form action="" class="d-flex justify-content-center align-items-center" id="search-form" style="position: relative;width: 75%">
                    <input type="text" id="movie" name="movie" class="form-control w-100 rounded-0 me-2" autocomplete="off" placeholder="Search....">
                    <button type="submit" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                    <div id="search-tag" class="search-tag d-none">
                        <div class="wrrap-search">
                            <ul id="tag-li">
                            </ul>
                        </div>
                    </div>
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
    const  loader = `<div class="spinner-border"role="status"> <span class="visually-hidden">Loading...</span></div>`
    $('#search-form').on('submit', function (e){
        e.preventDefault();
        let data = $(this).serialize();
        // localStorage.setItem("search",JSON.stringify([]));
        console.log(data);
        let searchVal =   JSON.parse(localStorage.getItem("search")) ?  JSON.parse(localStorage.getItem("search")) : [];
        let val = $('#movie').val();
        // search stroge
        if (val=="") {
        }else{
            // var datas = JSON.parse(localStorage.getItem("search"));
            if(searchVal.indexOf(val) === -1) {
                let search = [val,...searchVal]
                localStorage.setItem("search",JSON.stringify(search));
            }
        }
        $('#search-tag').addClass('d-none');
        $('#search-item').html(loader)
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
                    el.empty();
                }
            }
        })
        .catch(function (error){
            console.log(error);
        })
    })

    function searchGet(search) {
        $('#search-item').html(loader)
        client.get('/search?movie='+search)
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
                    el.empty();
                }
            }
        })
        .catch(function (error){
            console.log(error);
        })
    }

    $('#movie').click(function(){
        $('#search-tag').removeClass('d-none');
        loadSearch();
    });

    function loadSearch(){
        $('#tag-li').html(" ")
        var datas  = JSON.parse(localStorage.getItem("search")) ?  JSON.parse(localStorage.getItem("search")) : [];
        $.each(datas, function(k, v) {
            $('#tag-li').append(`<li><i class="bi bi-clock"></i> <a href="" class="search-text" data-val="${v}"  >${v}</a><button type="button" data-val="${v}" data-id="${k}" class="removeSearch btn-close" aria-label="Close"></button></li>`);
        });
    }

    $('.modal-body').click(function(){
        $('#search-tag').addClass('d-none')
    });

    $('.logo').click(function(){
        $('#search-tag').addClass('d-none')
    });
    $(document).on('click','.removeSearch', function(){
        let id = $(this).data('id');
        let val = $(this).data('val');

        var datas = JSON.parse(localStorage.getItem("search"));
        var index = datas.indexOf(val);
        datas.splice(index, 1);

        localStorage.setItem("search",JSON.stringify(datas));
        loadSearch();
    });

    $(document).on('click','.search-text', function(e){
        e.preventDefault();
        let val = $(this).data('val');
        $('#search-tag').addClass('d-none')
        $('#movie').val(val);
        searchGet(val)
    });

    function SearchTemplate(el, item){
        el.append(`
            <div class="cursor-pointer col-3 pt-2 pb-2">
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
