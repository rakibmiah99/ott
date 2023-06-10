<div class="modal fade" id="deletemodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center">
            {{--<div class="modal-header">
                <h5 class="modal-title">Delete Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>--}}
            <div class="modal-body text-center">
                <i class="bi bi-x-circle text-danger delete-icon"></i>
               <h4 > Are You Want to Delete ?</h4>
                <p>If you delete, you can not back again.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="final-delete-btn" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#final-delete-btn').on('click', function (){
        PreloaderOn();
        ModalClose();
        let data_id = $(this).attr('data-id');
        admin.delete("{{route('subscription.plan.delete')}}?data-id="+data_id)
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

