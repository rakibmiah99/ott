<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Feature Movies</h5>
                    <div class="d-flex">
                        <button type="button" id="delete-selected-btn" class="btn btn-sm btn-outline-danger rounded-pill ps-3 pe-3 me-2"><i class="bx bx-trash"></i>Delete Selected</button>
                        <button data-bs-toggle="modal" id="ordering-modal-btn" data-bs-target="#OrderingModel" type="button" class="btn btn-sm btn-outline-secondary rounded-pill ps-3 pe-3 me-2"><i class="bx bx-list-ul"></i>  Ordering</button>
                        <form id="filter-form" class="d-flex me-2">
                            <select id="category_name" name="category" class="form-select-sm form-control me-2 w-auto">
                                <option value="">All Category</option>
                                @foreach($category as $item)
                                    <option value="{{$item->name}}">{{$item->display_name}}</option>
                                @endforeach
                            </select>
                            <select name="sub_category" id="sub_category_name" class="form-select-sm form-control me-2 w-auto">
                                <option value="">Sub Category</option>
                            </select>
                            <input type="submit" class="btn btn-outline-info" value="Filter">
                        </form>
                        <button data-bs-toggle="modal" data-bs-target="#createmodal" type="button" class="btn btn-sm btn-primary rounded-pill ps-3 pe-3"><i class="bx bxs-plus-circle"></i> Add Movie To Feature</button>
                    </div>
                </div>
                <!-- Table with stripped rows -->
                <table class="table" id="DataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Sub Category</th>
                        <th scope="col">Movie Name</th>
                        <th scope="col">Movie Thumbnail</th>
                        <th scope="col"><button class="btn btn-light rounded-pill btn-sm select-all-btn" status="checked"> All </button> Actions  </th>
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


    $('#filter-form').on('submit', function(e){

        if($('#filter-form #category_name :selected').val() != ""){
            $('#ordering-modal-btn').removeClass('disabled');
        }

        e.preventDefault();
        // e.currentTarget.submit;
        let params = $(this).serialize();
        GetAll(params);
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

    $('#ordering-modal-btn').on('click', function (){
        GetOrdering();
    })


    if($('#filter-form #category_name :selected').val() != ""){
        $('#ordering-modal-btn').removeClass('disabled');
    }
    else{
        $('#ordering-modal-btn').addClass('disabled');
        $('#ordering-modal-btn').attr('title', 'please select a home category.');
    }


    // let param = '';
    let param = $('#filter-form').serialize();




    $('#delete-selected-btn').on('click', function (){
        let selected = $('.select-btn:checkbox:checked');
        let ids = [];
        for(let i =0; i < selected.length; i++){
            let id = Number(selected[i].getAttribute('data-id'));
            ids.push(id)
        }
        admin.delete('{{route('feature.delete')}}?multiple='+JSON.stringify(ids))
        .then(function (response){
            if(response.status == 200){
                GetAll(param);
            }
        })
        .catch(function(error){
            AxiosErrorHandle(error)
        })
    });


    $('#DataTable').on('click', '.select-btn', function(){
        DeleteButtonActive();
    });

    $('#DataTable').on('click', '.select-all-btn', function(){
        let ths = $(this);
        let checkbox = $('input[name=multiple]');
        let status = ths.attr('status');
        if(status == "checked"){
            ths.attr('status', 'unchecked');
            ths.html("Unchecked");
            checkbox.prop('checked', false);
            checkbox.prop('checked', true);

        }
        else{
            ths.attr('status', 'checked');
            checkbox.prop('checked', false);
            ths.html("All")
        }
        DeleteButtonActive();
    })

    DeleteButtonActive();
    function DeleteButtonActive(){
        let selected = $('input[name=multiple]:checkbox:checked').length;
        if(selected > 0){
            $('#delete-selected-btn').removeClass('disabled');
        }
        else{
            $('#delete-selected-btn').addClass('disabled');
        }
    }






    OrderButtonActive();
    function OrderButtonActive(){
        let val = $('#search-by-category :selected').val();
        if(val == ""){
            $('#ordering-modal-btn').addClass('disabled');
            $('#ordering-modal-btn').attr('title', 'please select a home category.');
        }
        else{
            $('#ordering-modal-btn').removeClass('disabled');
            $('#ordering-modal-btn').removeAttr('title');
        }
    }


    function GetAll(param = ''){
        PreloaderOn();
        let table_data = $('#table-data')
        admin.get("{{route('feature.get.all')}}?"+param).
        then(function (response){
            PreloaderOff();
            if(response.status == 200){
                var table = $('#DataTable').DataTable();
                table.destroy();
                table_data.empty();
                let data = response.data;
                if(data.length == 0 || $('#filter-form #category_name :selected').val() == ""){
                    $('#ordering-modal-btn').addClass('disabled');
                    $('#ordering-modal-btn').attr('title', 'please select a category.');
                }

                data.forEach(function (item, index){
                    Template(item, ++index);
                });

                table = $('#DataTable').DataTable({
                    stateSave: true,
                    retrieve: true,
                    responsive: true,
                    processing: true,
                    columnDefs: [
                        { orderable: false, targets: -1 }
                    ]
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
                        <td>${item.category}</td>
                        <td>${item.sub_category}</td>
                        <td>${item.movie_display_name}</td>
                        <td>
                            <img src="${item.tumbnail}" height="100px">
                        </td>
                        <td >
                            <div class="d-flex align-items-center">
                                <input type="checkbox" name="multiple" class="me-2 select-btn" data-id="${item.id}" style="height: 20px;width: 20px">
                                <button data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#deletemodal" type="button" class="btn btn-delete btn-sm btn-outline-danger rounded-pill ps-2 pe-2"><i class="bx bxs-trash"></i></button>
                            </div>
                        </td>
                    </tr>
            `)
        }
    }
    GetAll(param);


    //set delete data
    $('#table-data').on('click', '.btn-delete', function (){
        let data_id = $(this).attr('data-id');
        $('#final-delete-btn').attr('data-id', data_id);
    });

    //Set Data To Edit Modal
    $('#table-data').on('click', '.edit-btn', function (){
        let data_id = $(this).attr('data-id');
        ModalLoadingOn();
        admin.get("{{route('sub.category.get.single')}}?data-id="+data_id)
        .then(function (response){
            ModalLoadingOff();
            if(response.status === 200){
               let data = response.data;
               let input = Object.keys(data)
                input.forEach(function (name){
                   $(`#update-form input[name=${name}]`).val(data[name]);
                   $(`#update-form select[name=${name}]`).val(data[name]);
                   console.log(data[name])
                });
            }
        })
        .catch(function (error){
            AxiosErrorHandle(error)
        })
    })
</script>
