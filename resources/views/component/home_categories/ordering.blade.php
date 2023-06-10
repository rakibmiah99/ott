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
    GetOrdering();
    function GetOrdering(){
        PreloaderOn();
        let list_items = $('#list-items');
        admin.get("{{route('home.category.get.all')}}").
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


        function Template(item, index){
            list_items.append(`
                <tr data-id="${item.id}" class="cursor-move list-group-item d-flex justify-content-start">
                    <td>${item.display_name}</td>
                </tr>
            `)
        }

        $('#save-order').on('click', function (){
            SaveOrder($('#list-items tr'), "{{route('home.category.rearrange')}}", GetAll)
        })
    }
</script>
