<div class="modal fade" id="updatemodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title">Update Film Industry</h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update-form" class="row g-3 p-3">
                <input type="hidden" name="id">
                <div class="col-12">
                    <label for="display_name" class="form-label">Name <span class="text-danger err-message"></span></label>
                    <input type="text"  name="display_name" class="form-control" id="display_name">
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
        await admin.post("{{route("film.update")}}", formData)
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
