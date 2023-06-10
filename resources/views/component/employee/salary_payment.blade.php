<div class="modal fade" id="salary-payment" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Employee Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-form" class="row g-3 p-3">
                <div class="col-6">
                    <label for="basic_salary" class="form-label">Pay Amount</label>
                    <input type="number" step="any" name="amount" required class="form-control" id="pay_amount">
                </div>
                <div class="col-6">
                    <label for="basic_salary" class="form-label">Date</label>
                    <input type="date"  required name="pay_date" class="form-control" id="date">
                </div>
                <div class="col-12">
                    <label for="name" class="form-label">Employee Name</label>
                    <input type="text" disabled class="form-control" id="name">
                </div>
                <div class="col-6">
                    <label for="basic_salary" class="form-label">Basic Salary</label>
                    <input type="number" disabled  class="form-control" id="basic_salary">
                </div>
                <div class="col-6">
                    <label for="basic_salary" class="form-label">Total Pay</label>
                    <input type="number" disabled  class="form-control" id="total_pay">
                </div>
                <div class="col-6">
                    <label for="basic_salary" class="form-label">Total Payable</label>
                    <input type="number" disabled  class="form-control" id="total_payable">
                </div>
                <div class="col-6">
                    <label for="basic_salary" class="form-label">Number Of Day Works </label>
                    <input type="number" disabled  class="form-control" id="number_of_day_works">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </div>
            </form>
            @include('component.loading')
        </div>
    </div>
</div>

<script>
    $('#create-form').on('submit',async function (e){
        e.preventDefault();
        RemoveErrorBorder($(this));
        let data = $(this).serializeArray();
        let formData = new FormData();
        data.forEach(function(item){
            formData.append(item.name, item.value);
        });

        PreloaderOn();
        await axios.post("{{route("employee.create")}}", formData)
            .then(function (response){
                ModalClose();
                $('#create-form')[0].reset();
                GetAll();
            })
            .catch(function (error){
                AxiosErrorHandle(error, '#create-form')
            });

        // e.currentTarget.submit()
    });
</script>
