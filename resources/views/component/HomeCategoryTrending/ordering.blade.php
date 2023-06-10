<div class="modal fade" id="OrderingModel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ordering Items</h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <table id="list-items" class="row table-striped table-hover list-group list-group-flush list-group-numbered g-3 p-3">

            </table>
            <button id="save-order" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>

<script>

    function GetOrdering(){
        PreloaderOn();
        let list_items = $('#list-items');
        let home_category = $('#search-by-category :selected').val();
        if(home_category != ""){
            admin.get("{{route('home.visibility.get.all')}}?home-category="+home_category).
            then(function (response){
                PreloaderOff();
                if(response.status == 200){
                    list_items.empty();
                    let data = response.data;
                    data.forEach(function (item, index){
                        Template(item, ++index);
                    });
                    list_items.sortable();
                }
            }).
            catch(function (error){
                AxiosErrorHandle(error)
            })
        }
        else{
            ToastError("Home Category Not Selected!");
            ModalClose();
            PreloaderOff();
        }


        function Template(item, index){
            list_items.append(`
                <tr data-id="${item.id}" class="cursor-move list-group-item d-flex justify-content-start">
                    <td>${item.movie_display_name}</td>
                </tr>
            `)
        }

        $('#save-order').on('click', function (){
            let home_category = $('#search-by-category :selected').val();
            SaveOrder($('#list-items tr'), "{{route('home.visibility.rearrange')}}?home-category="+home_category, GetAll, param)
        })
    }
</script>
