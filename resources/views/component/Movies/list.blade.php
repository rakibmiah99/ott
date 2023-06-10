<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Movies</h5>
                    <div class="d-flex">
                        <form id="filter-form" class="d-flex me-2">
                            <select id="category_name" name="category_name" class="form-select-sm form-control me-2 w-auto">
                                <option value="">All Category</option>
                                @foreach($categories as $item)
                                    <option class="{{$item->name}}">{{$item->display_name}}</option>
                                @endforeach
                            </select>
                            <select name="sub_category_name" id="sub_category_name" class="form-select-sm form-control me-2 w-auto">
                                <option value="">Sub Category</option>
                            </select>
                            <select id="film_industries_name" name="film_industries_name" class="form-select-sm form-control me-2 w-auto">
                                <option value="">Industries</option>
                                @foreach($industries as $item)
                                    <option class="{{$item->name}}">{{$item->display_name}}</option>
                                @endforeach
                            </select>
                            <select id="paly_mode" name="play_mode" class="form-select-sm form-control me-2 w-auto">
                                <option value="">Play Mode</option>
                                <option value="free">Free</option>
                                <option value="Paid">Paid</option>
                            </select>
                            <input type="submit" class="btn btn-outline-info" value="Filter">
                        </form>
                        <button data-bs-toggle="modal" data-bs-target="#createmodal" type="button" class="btn btn-sm btn-primary {{--rounded-pill--}} ps-3 pe-3"><i class="bx bxs-plus-circle"></i> Add Movie</button>
                    </div>

                </div>
                <!-- Table with stripped rows -->
                <table class="table" id="DataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Category</th>
                        <th scope="col">Sub Category</th>
                        <th scope="col">Industry</th>
{{--                        <th title="Home Category" scope="col">H. Category</th>--}}
                        <th scope="col">Type</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="table-data">

                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>

    </div>
</div>
<script>

    let params = '';
    $('#filter-form').on('submit', function (e){
        e.preventDefault();
        let params = $(this).serialize();
        GetAll(params)

    })


    $('#filter-form #category_name').on('change', function (){
        admin.get("{{route('sub.category.get.all')}}?main-category="+$(this).val())
            .then(function (response){
                if(response.status === 200){
                    let sub_cat_el  = $('#filter-form #sub_category_name');
                    sub_cat_el.empty();
                    sub_cat_el.append(`<option value="">Select</option>`);
                    let data = response.data;
                    data.forEach(function(item){
                        sub_cat_el.append(`<option value="${item.name}">${item.display_name}</option>`);
                    })
                }
            })
            .catch(function (error){
                AxiosErrorHandle(error);
            })
    })





    function GetAll(params=''){
        PreloaderOn();
        let table_data = $('#table-data')
        admin.get("{{route('movie.get.all')}}?"+params).
        then(function (response){
            PreloaderOff();
            if(response.status == 200){
                // var table = $('#DataTable').DataTable();
                // table.destroy();
                table_data.empty();
                let data = response.data;
                data.forEach(function (item, index){
                    Template(item, ++index);
                });

                table = $('#DataTable').DataTable({
                    stateSave: true,
                    retrieve: true,
                    responsive: true,
                    processing: true,
                });

            }
        }).
        catch(function (error){
           AxiosErrorHandle(error)
        })

        function Template(item, index){
            table_data.append(`
                <tr>
                        <th scope="row">${index}</th>
                        <td>${item.display_name}</td>
                        <td><img src="${item.tumbnail}" class="img-fluid"  style="height: 70px;" alt="${item.name}"/></td>
                        <td>${item.category}</td>
                        <td>${item.sub_category}</td>
                        <td>${item.film_industry}</td>
                        <td>${item.video_type}</td>
                        <td>${item.visibility == 1 ? 'Visible' : 'Hidden' }</td>
                        <td>
                            <button data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#updatemodal" type="button" class="btn edit-btn btn-sm btn-outline-success rounded-pill ps-2 pe-2"><i class="bx bxs-pencil"></i></button>
                            <button data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#deletemodal" type="button" class="btn btn-delete btn-sm btn-outline-danger rounded-pill ps-2 pe-2"><i class="bx bxs-trash"></i></button>
                        </td>
                    </tr>
            `)
        }
    }
    GetAll();


    //set delete data
    $('#table-data').on('click', '.btn-delete', function (){
        let data_id = $(this).attr('data-id');
        $('#final-delete-btn').attr('data-id', data_id);
    });

    //salary payment
    $('#table-data').on('click', '.edit-btn', function (){
        let data_id = $(this).attr('data-id');
        ModalLoadingOn();
        admin.get("{{route('movie.get.single')}}?data-id="+data_id)
        .then(function (response){
            ModalLoadingOff();
            if(response.status === 200){
               let data = response.data;
               let input = Object.keys(data)

                admin.get("{{route('sub.category.get.all')}}?main-category="+data.category_name)
                    .then(function (response){
                        if(response.status === 200){
                            let sub_cat_el  = $('#update-form #sub_category_name');
                            sub_cat_el.empty();
                            sub_cat_el.append(`<option value="">Select</option>`);
                            let sub_cat_data = response.data;
                            sub_cat_data.forEach(function(item){
                                sub_cat_el.append(`<option value="${item.name}">${item.display_name}</option>`);
                            })
                            sub_cat_el.val(data.sub_category_name);
                        }
                    })
                    .catch(function (error){
                        AxiosErrorHandle(error);
                    })

                $('#update-form #movie_id').val(data.id);
                $('#update-form #display_name').val(data.display_name);
                $('#update-form #length').val(data.length);
                $('#update-form #play_mode').val(data.play_mode);
                $('#update-form #visibility').val(data.visibility);
                $('#update-form #imdb').val(data.imdb);
                $('#update-form #category_name').val(data.category_name);
                $('#update-form #sub_category_name').val(data.sub_category_name);
                $('#update-form #film_industries_name').val(data.film_industries_name);
                $('#update-form #video_type_name').val(data.video_type_name);
                $('#update-form #home_category_name').val(data.home_category_name);
                $('#update-form button[file-id=image_1]').attr('preview-url', data.image_1);
                $('#update-form button[file-id=image_2]').attr('preview-url', data.image_2);
                $('#update-form button[file-id=image_3]').attr('preview-url', data.image_3);
                $('#update-form button[file-id=image_4]').attr('preview-url', data.image_4);
                $('#update-form #tumbnail-btn').attr('preview-url', data.tumbnail);

                uquill.root.innerHTML = data.description;


                // console.log(quill.root.innerHTML)

                /*input.forEach(function (name){
                    console.log(data[name])
                   $(`#update-form input[name=${name}]`).val(data[name]);
                   $(`#update-form select[name=${name}]`).val(data[name]);
                });*/
            }
        })
        .catch(function (error){
            AxiosErrorHandle(error)
        })
    })
</script>
