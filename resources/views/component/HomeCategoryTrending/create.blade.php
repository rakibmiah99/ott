<div class="modal fade" id="createmodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Movie To Home Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-form" class="row g-3 p-3">
                <div class="col-12 d-flex flex-column">
                    <label for="home_category_name" class="form-label">Main Category Name <span class="text-danger err-message"></span></label>
                    <select id="home_category_name" name="home_category_name" class="form-select form-control me-2 w-100">
                        <option value="">Select</option>
                        @foreach($home_category as $item)
                            <option value="{{$item->name}}">{{$item->display_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="movie_name" class="form-label">Name <span class="text-danger err-message"></span></label>
                    <select name="movie_name[]" class="form-control" id="movie_name" multiple="multiple">
                        <option value="">Select</option>
                    </select>
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

    $('#home_category_name').on('change', function (){
        let value = $(this).val();
        admin.get(`{{route('movie.get.selectable')}}?home_category_name=`+value)
        .then(function (response){
            if(response.status === 200){
                let input = $('#create-form #movie_name');
                input.empty();
                let movies = response.data;
                // input.append(`<option value="">Select</option>`)
                movies.forEach(function (movie){
                    input.append(`
                        <option value="${movie.name}">${movie.display_name}</option>
                    `)
                })

                input.select2({
                    tags: true,
                    dropdownParent: $('#createmodal')
                });
            }
        })
        .catch(function (error){
            console.log(error)
        })
    })

    $('#create-form').on('submit',async function (e){
        e.preventDefault();
        RemoveErrorBorder($(this));
        let data = $(this).serializeArray();
        let formData = new FormData();
        data.forEach(function(item){
            formData.append(item.name, item.value);
        });

        PreloaderOn();
        await admin.post("{{route('home.visibility.save')}}", formData)
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
