<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title">All Categories</h5>
{{--                    <button data-bs-toggle="modal" data-bs-target="#createmodal" type="button" class="btn btn-sm btn-primary rounded-pill ps-3 pe-3"><i class="bx bxs-plus-circle"></i> Add Film Industry</button>--}}
                </div>
                <!-- Table with stripped rows -->
                <table class="table" id="DataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
{{--                        <th scope="col">Actions</th>--}}
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

    function GetAll(){
        PreloaderOn();
        let table_data = $('#table-data')
        admin.get("{{route('main.category.get.all')}}").
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
                        <td>${item.display_name}</td>
                    </tr>
            `)
        }
    }
    GetAll();


    /*//set delete data
    $('#table-data').on('click', '.btn-delete', function (){
        let data_id = $(this).attr('data-id');
        $('#final-delete-btn').attr('data-id', data_id);
    });

    //salary payment
    $('#table-data').on('click', '.edit-btn', function (){
        let data_id = $(this).attr('data-id');
        ModalLoadingOn();
        admin.get("{{route('film.get.single')}}?data-id="+data_id)
        .then(function (response){
            ModalLoadingOff();
            if(response.status === 200){
               let data = response.data;
               let input = Object.keys(data)
                input.forEach(function (name){
                   $(`input[name=${name}]`).val(data[name]);
                });
            }
        })
        .catch(function (error){
            AxiosErrorHandle(error)
        })
    })*/
</script>
