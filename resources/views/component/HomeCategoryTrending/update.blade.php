<div class="modal fade" id="updatemodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title">Update Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update-form" class="row g-3 p-3">
                <input type="hidden" name="id">
                <div class="col-12">
                    <label for="main_category_name" class="form-label">Main Category Name <span class="text-danger err-message"></span></label>
                    <select id="main_category_name" name="main_category_name" class="form-select form-control me-2 w-100">
                        <option value="">Select</option>
                        @foreach($main_category as $item)
                            <option value="{{$item->name}}">{{$item->display_name}}</option>
                        @endforeach
                    </select>
                </div>
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
        await admin.post("{{route("sub.category.update")}}", formData)
            .then(function (response){
                $('#update-form')[0].reset();
                GetAll(param);
            })
            .catch(function (error){
                AxiosErrorHandle(error, '#update-form')
            });
        // e.currentTarget.submit()
    });
</script>
