<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Sub Category</h5>
                    <div class="d-flex">
                        <select id="search-by-category" class="form-select-sm form-control me-2 w-auto">
                            <option value="">All Category</option>
                            @foreach($main_category as $item)
                                <option class="{{$item->name}}">{{$item->display_name}}</option>
                            @endforeach
                        </select>
                        <button data-bs-toggle="modal" data-bs-target="#createmodal" type="button" class="btn btn-sm btn-primary rounded-pill ps-3 pe-3"><i class="bx bxs-plus-circle"></i> Add Film Industry</button>
                    </div>
                </div>
                <!-- Table with stripped rows -->
                <table class="table" id="DataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Main Category</th>
                        <th scope="col">Name</th>
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

    let param = '';
    $('#search-by-category').on('change', function (){
        param = "?main-category="+$(this).val();
       GetAll(param);
    });


    function GetAll(param = ''){
        PreloaderOn();
        let table_data = $('#table-data')
        admin.get("{{route('sub.category.get.all')}}"+param).
        then(function (response){
            PreloaderOff();
            if(response.status == 200){
                var table = $('#DataTable').DataTable();
                table.destroy();
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
                        <td>${item.mc_display_name}</td>
                        <td>${item.display_name}</td>
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
