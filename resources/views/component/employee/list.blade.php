<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Emplyee List</h5>
                    <button data-bs-toggle="modal" data-bs-target="#createmodal" type="button" class="btn btn-sm btn-primary rounded-pill ps-3 pe-3"><i class="bx bxs-plus-circle"></i> Add Employee</button>
                </div>
                <!-- Table with stripped rows -->
                <table class="table" id="DataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Basic Salary</th>
                        <th scope="col">PDS</th>
                        <th scope="col">PTM</th>
                        <th scope="col">TWD</th>
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

    function GetAll(){
        PreloaderOn();
        let table_data = $('#table-data')
        axios.get("{{route('employee.get.all')}}").
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
            console.log({...error})
        })

        function Template(item, index){
            table_data.append(`
                <tr>
                        <th scope="row">${index}</th>
                        <td>${item.name}</td>
                        <td>${item.phone}</td>
                        <td>${item.basic_salary}</td>
                        <td>${item.day_salary.toFixed(2)}</td>
                        <td>${item.amount.toFixed(2)}</td>
                        <td>${item.present} days</td>
                        <td>
                            <button emp-id="${item.emp_id}" data-bs-toggle="modal" data-bs-target="#salary-payment" type="button" class="btn btn-sm salary-btn btn-outline-dark rounded-pill ps-2 pe-2"><i class="bx bx-money-withdraw"></i></button>
                            <button emp-id="${item.emp_id}" type="button" class="btn btn-sm btn-outline-primary rounded-pill ps-2 pe-2"><i class="bx bi-eye"></i></button>
                            <button emp-id="${item.emp_id}" data-bs-toggle="modal" data-bs-target="#updatemodal" type="button" class="btn edit-btn btn-sm btn-outline-success rounded-pill ps-2 pe-2"><i class="bx bxs-pencil"></i></button>
                            <button emp-id="${item.emp_id}" data-bs-toggle="modal" data-bs-target="#deletemodal" type="button" class="btn btn-delete btn-sm btn-outline-danger rounded-pill ps-2 pe-2"><i class="bx bxs-trash"></i></button>
                        </td>
                    </tr>
            `)
        }
    }
    GetAll();


    //set delete data
    $('#table-data').on('click', '.btn-delete', function (){
        let emp_id = $(this).attr('emp-id');
        $('#final-delete-btn').attr('emp-id', emp_id);
    });

    //set delete data
    $('#table-data').on('click', '.salary-btn', function (){
        let emp_id = $(this).attr('emp-id');
        ModalLoadingOn();
        axios.get("{{route('employee.get.single')}}?emp_id="+emp_id)
        .then(function (response){
            ModalLoadingOff();
            if(response.status === 200){
               let data = response.data;
               let inputs = Object.keys(data);
               inputs.forEach(function (item){
                   $(`#update-form input[name=${item}]`).val(data[item]);
                   $(`#update-form textarea[name=${item}]`).html(data[item]);
               })
            }
        })
        .catch(function (error){
            AxiosErrorHandle(error)
        })
    });

    //salary payment
    $('#table-data').on('click', '.edit-btn', function (){
        let emp_id = $(this).attr('emp-id');
        ModalLoadingOn();
        axios.get("{{route('employee.payment.info')}}?emp_id="+emp_id)
        .then(function (response){
            ModalLoadingOff();
            if(response.status === 200){
               let data = response.data;
            }
        })
        .catch(function (error){
            AxiosErrorHandle(error)
        })
    })
</script>
