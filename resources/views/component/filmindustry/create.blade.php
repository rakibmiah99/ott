<div class="modal fade" id="createmodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Film Industry</h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-form" class="row g-3 p-3">
                <div class="col-12">
                    <label for="display_name" class="form-label">Name <span class="text-danger err-message"></span></label>
                    <input type="text"  name="display_name" class="form-control" id="display_name">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
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
        await admin.post("{{route('film.save')}}", formData)
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
