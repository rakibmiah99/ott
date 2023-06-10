<div class="modal fade" id="updatemodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title">Update Subscription Plane</h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update-form" class="row g-3 p-3">
                <input type="hidden" name="id">
                <div class="col-3">
                    <label for="subcription_id" class="form-label">Subscription ID</label>
                    <input type="text"  name="subcription_id" class="form-control" id="subcription_id">
                </div>
                <div class="col-3">
                    <label for="duration_day" class="form-label">Duration Day</label>
                    <input type="number"  name="duration_day" class="form-control" id="duration_day">
                </div>
                <div class="col-3">
                    <label for="duration_month" class="form-label">Duration Month</label>
                    <input type="number"  name="duration_month" class="form-control" id="duration_month">
                </div>
                <div class="col-3">
                    <label for="duration_year" class="form-label">Duration Year</label>
                    <input type="number"  name="duration_year" class="form-control" id="duration_year">
                </div>
                <div class="col-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="any"  name="price" class="form-control" id="price">
                </div>
                <div class="col-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" step="any"  name="discount" class="form-control" id="discount">
                </div>
                <div class="col-3">
                    <label for="discount_type" class="form-label">Discount Type</label>
                    <select  name="discount_type" class="form-control" id="discount_type">
                        <option value="">Select</option>
                        <option value="flat">Flat</option>
                        <option value="percentage">Percentage</option>
                    </select>
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
        await admin.post("{{route("subscription.plan.update")}}", formData)
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
