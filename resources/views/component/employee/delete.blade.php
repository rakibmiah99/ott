<div class="modal fade" id="deletemodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vertically Centered</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="final-delete-btn" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#final-delete-btn').on('click', function (){
        PreloaderOn();
        ModalClose();
        let emp_id = $(this).attr('emp-id');
        axios.delete("{{route('employee.delete')}}?emp_id="+emp_id)
        .then(function (response){
            if(response.status == 200){
                GetAll();
            }
        })
        .catch(function(error){
            AxiosErrorHandle(error)
        })
    })
</script>

