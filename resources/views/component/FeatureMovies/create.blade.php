<div class="modal fade" id="createmodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Movie To Feature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-form" class="row g-3 p-3">
                <div class="col-12 d-flex flex-column">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-select form-control me-2 w-100">
                        <option value="">Select</option>
                        @foreach($category as $item)
                            <option value="{{$item->name}}">{{$item->display_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="sub_category" class="form-label">Sub Category</label>
                    <select name="sub_category" class="form-control" id="sub_category">
                        <option value="">Select</option>
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

    $('#create-form #category').on('change', function (){
        admin.get("http://127.0.0.1:8000/api/admin/sub-category/get?main-category="+$(this).val())
            .then(function (response){
                if(response.status === 200){
                    let sub_cat_el  = $('#create-form #sub_category');
                    sub_cat_el.empty();
                    sub_cat_el.append(`<option value="">Select</option>`);
                    let data = response.data;
                    data.forEach(function(item){
                        sub_cat_el.append(`<option value="${item.name}">${item.display_name}</option>`);
                    })
                }
            })
            .catch(function (error){
                AxiosErrorHandle(error);
            })
    })



    $('#category').on('change', function (){
        let value = $(this).val();
        admin.get(`{{route('movie.get.selectable')}}?category=`+value)
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
    $('#sub_category').on('change', function (){
        let category = $('#category :selected').val();
        let value = $(this).val();
        admin.get(`{{route('movie.get.selectable')}}?category=${category}&sub_category=${value}`)
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
        await admin.post("{{route('feature.save')}}", formData)
        .then(function (response){
            ModalClose();
            $('#create-form')[0].reset();
            GetAll(param);
        })
        .catch(function (error){
            AxiosErrorHandle(error, '#create-form')
        });

        // e.currentTarget.submit()
    });
</script>
