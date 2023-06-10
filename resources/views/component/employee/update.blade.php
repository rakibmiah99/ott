<div class="modal fade" id="updatemodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update-form" class="row g-3 p-3">
                <input type="hidden" name="emp_id">
                <div class="col-12">
                    <label for="name" class="form-label">Employee Name <span class="text-danger err-message"></span></label>
                    <input type="text"  name="name" class="form-control" id="name">
                </div>
                <div class="col-12">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" id="phone">
                </div>

                <div class="col-6">
                    <label for="basic_salary" class="form-label">Basic Salary</label>
                    <input type="number" required name="basic_salary" step="any" class="form-control" id="basic_salary" placeholder="10000">
                </div>
                <div class="col-6">
                    <label for="joining_date" class="form-label">Joining Date</label>
                    <input type="date" required step="any" class="form-control" name="joining_date" id="joining_date" placeholder="10000">
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea type="text" class="form-control" name="address" id="address"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
            @include('component.loading')
        </div>
    </div>
</div>

<script>
    $('#update-form').on('submit',async function (e){
        e.preventDefault();
        RemoveErrorBorder($(this));
        let data = $(this).serializeArray();
        let formData = new FormData();
        data.forEach(function(item){
            formData.append(item.name, item.value);
        });
        PreloaderOn();
        ModalClose();
        await axios.post("{{route("employee.update")}}", formData)
            .then(function (response){
                $('#update-form')[0].reset();
                GetAll();
            })
            .catch(function (error){
                AxiosErrorHandle(error, '#update-form')
            });

        // e.currentTarget.submit()
    });
</script>
