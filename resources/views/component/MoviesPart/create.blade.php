<div class="modal fade" id="createmodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Movie Part</h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-form" class="row g-3 p-3 bg-white" enctype="multipart/form-data">
                <div class="col-2 d-flex flex-column">
                    <label for="movies_name" class="form-label">Select A Movie</label>
                    <select id="movies_name" name="movies_name" class="form-control form-select">
                        <option value="">Select</option>
                        @foreach($movies as $movie)
                            <option value="{{$movie->name}}">{{$movie->display_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="display_name" class="form-label">Movie Name</label>
                    <input type="text"  name="display_name" class="form-control" id="display_name">
                </div>
                <div class="col-2">
                    <label for="length" class="form-label">Length (minute)</label>
                    <input type="number" step="any"  name="length" class="form-control" id="length">
                </div>
                <div class="col-2">
                    <label for="play_mode" class="form-label">Play Mode</label>
                    <select id="play_mode" name="play_mode" class="form-control form-select">
                        <option value="">Select</option>
                        <option value="free">free</option>
                        <option value="paid">paid</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="visibility" class="form-label">Visibility</label>
                    <select id="visibility" name="visibility" class="form-control form-select">
                        <option value="">Select</option>
                        <option value="1">Visible</option>
                        <option value="0">Hidden</option>
                    </select>
                </div>


                <div class="col-3">
                    <label for="image_1" class="form-label">Image 1</label>
                    <div class="d-flex">
                        <input type="file" name="image_1" class="form-control me-2" id="image_1">
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#image1_preview_modal"
                            type="button"
                            class="btn image-preview-btn btn-outline-primary"
                            file-id = 'image_1'
                            title="Image 1 Preview"
                            triger-modal="createmodal"
                        >
                            <i class="bx bx-image"></i>
                        </button>
                    </div>
                </div>
                <div class="col-3">
                    <label for="image_2" class="form-label">Image 2</label>
                    <div class="d-flex">
                        <input type="file" name="image_2" class="form-control me-2" id="image_2">
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#image1_preview_modal"
                            type="button"
                            class="btn image-preview-btn btn-outline-primary"
                            file-id = 'image_2'
                            title="Image 2 Preview"
                            triger-modal="createmodal"
                        >
                            <i class="bx bx-image"></i>
                        </button>
                    </div>
                </div>
                <div class="col-3">
                    <label for="image_3" class="form-label">Image 3</label>
                    <div class="d-flex">
                        <input type="file" name="image_3" class="form-control me-2" id="image_3">
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#image1_preview_modal"
                            type="button"
                            class="btn image-preview-btn btn-outline-primary"
                            file-id = 'image_3'
                            title="Image 3 Preview"
                            triger-modal="createmodal"
                        >
                            <i class="bx bx-image"></i>
                        </button>
                    </div>
                </div>
                <div class="col-3">
                    <label for="image_4" class="form-label">Image 4</label>
                    <div class="d-flex">
                        <input type="file" name="image_4" class="form-control me-2" id="image_4">
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#image1_preview_modal"
                            type="button"
                            class="btn image-preview-btn btn-outline-primary"
                            file-id = 'image_4'
                            title="Image 4 Preview"
                            triger-modal="createmodal"
                        >
                            <i class="bx bx-image"></i>
                        </button>
                    </div>
                </div>

                <div class="col-3">
                    <label for="video" class="form-label">Video</label>
                    <div class="d-flex">
                        <input type="file" name="video" class="form-control me-2" id="video">
                        {{--<button
                            data-bs-toggle="modal"
                            data-bs-target="#video_preview"
                            type="button"
                            class="btn video-preview-btn btn-outline-primary"
                            file-id = 'video'
                            title="Video Preview"
                        >
                            <i class="bx bx-movie-play"></i>
                        </button>--}}
                    </div>
                </div>

                <div class="col-3">
                    <label for="tumbnail" class="form-label">Thumbnail</label>
                    <div class="d-flex">
                        <input type="file" name="tumbnail" class="form-control me-2" id="tumbnail">
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#image1_preview_modal"
                            type="button"
                            class="btn image-preview-btn btn-outline-primary"
                            file-id = 'tumbnail'
                            title="Thumbnail Preview"
                            triger-modal="createmodal"
                        >
                            <i class="bx bx-image"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <div style="height: 250px;" id="create-editor" class="quill-editor-default">
                        <p>Hello World!</p>
                        <p>This is Quill <strong>default</strong> editor</p>
                    </div>
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
    $("#create-form #movies_name").select2({
        tags: true,
        dropdownParent: $('#createmodal'),
        // theme: "classic",
    });


    var quill = new Quill('#create-editor', {
        modules: {
            toolbar: [
                [{
                    font: []
                }, {
                    size: []
                }],
                ["bold", "italic", "underline", "strike"],
                [{
                    color: []
                },
                    {
                        background: []
                    }
                ],
                [{
                    script: "super"
                },
                    {
                        script: "sub"
                    }
                ],
                [{
                    list: "ordered"
                },
                    {
                        list: "bullet"
                    },
                    {
                        indent: "-1"
                    },
                    {
                        indent: "+1"
                    }
                ],
                ["direction", {
                    align: []
                }],
                ["link", "image", "video"],
                ["clean"]
            ]
        },
        theme: "snow"
    });

    /*$('.video-preview-btn').on('click', function (){
        // $('#video_preview_input').attr('src', 'none.mpg')
        let file_id = $(this).attr('file-id');
        let file = document.getElementById(file_id).files[0];
        let src = URL.createObjectURL(file);
        console.log(src)
        // $('#video_preview_input').attr('src', src);
    })*/

    $('#create-form .image-preview-btn').on('click', function (){
        let triggerModal = $(this).attr('triger-modal');
        $('#back-modal').attr('data-bs-target', '#'+triggerModal);
        $('#image1_preview_modal .modal-title').html($(this).attr('title'))
        let file_id = $(this).attr('file-id');
        // let file = document.getElementById(file_id).files[0];
        // let file = document.querySelectorAll('#create-form '+"#"+file_id)[0].files[0];
        let file = $('#create-form #'+file_id).prop('files')[0];
        if(typeof file === undefined || typeof file == "undefined"){

        }
        else{
            let src = URL.createObjectURL(file);
            console.log(src)
            $('#image_1_preview').attr('src', src);
        }

    })


    $('#create-form #category_name').on('change', function (){
        admin.get("{{route('sub.category.get.all')}}?main-category="+$(this).val())
        .then(function (response){
            if(response.status === 200){
                let sub_cat_el  = $('#create-form #sub_category_name');
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


    $('#create-form').on('submit',async function (e){
        e.preventDefault();
        RemoveErrorBorder($(this));
        let data = $(this).serializeArray();
        console.log(data)
        let formData = new FormData();
        data.forEach(function(item){
            formData.append(item.name, item.value);
        });

        let image_1 = document.getElementById('image_1').files[0];
        let image_2 = document.getElementById('image_2').files[0];
        let image_3 = document.getElementById('image_3').files[0];
        let image_4 = document.getElementById('image_4').files[0];
        let tumbnail = document.getElementById('tumbnail').files[0];
        let video = document.getElementById('video').files[0];

        if(fileValidation(image_1,['png', 'jpeg', 'jpg'], 'Image 1') !== false && (typeof image_1 != "undefined" && typeof image_1 != undefined)){
            formData.append('image_1', image_1);
        }

        if(fileValidation(image_2,['png', 'jpeg', 'jpg'], 'image 2') !== false && (typeof image_2 != "undefined" && typeof image_2 != undefined) ){
            formData.append('image_2', image_2);
        }

        if(fileValidation(image_3,['png', 'jpeg', 'jpg'], 'image 3') !== false && (typeof image_3 != "undefined" && typeof image_3 != undefined)){
            formData.append('image_3', image_3);
        }
        if(fileValidation(image_4,['png', 'jpeg', 'jpg'], 'image 4') !== false && (typeof image_4 != "undefined" && typeof image_4 != undefined)){
            formData.append('image_4', image_4);
        }
        if(fileValidation(tumbnail,['png', 'jpeg', 'jpg'], 'Thumbnail') !== false && (typeof tumbnail != "undefined" && typeof tumbnail != undefined)){
            formData.append('tumbnail', tumbnail);
        }

        if(fileValidation(video,['mp4'], 'Video') !== false && (typeof video != "undefined" && typeof video != undefined)){
            formData.append('video', video);
        }



        formData.append('description', quill.root.innerHTML );


        // PreloaderOn();
        await admin.post("{{route('movie.part.save')}}", formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
            onUploadProgress: progressEvent => {
                console.log(progressEvent.total)
                let progress = Math.round(
                    (progressEvent.loaded / progressEvent.total) * 100
                );

                console.log(progress)
            },
        })
        .then(function (response){
            ModalClose();
            // $('#create-form')[0].reset();
            GetAll(params);
        })
        .catch(function (error){
            AxiosErrorHandle(error, '#create-form')
        });

        // e.currentTarget.submit()
    });


</script>
