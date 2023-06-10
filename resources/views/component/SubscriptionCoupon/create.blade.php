<div class="modal fade" id="createmodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Coupon <span class="ms-2 text-secondary" style="font-size: 12px" id="message"></span></h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-form" class="row g-3 p-3">
                <div class="col-3">
                    <label for="subcription_id" class="form-label">Subscription ID</label>
                    <select  name="subcription_id" class="form-control" id="subcription_id">
                        <option value="">Select</option>
                    @foreach($subscription_plan as $item)
                        <option  discount="{{$item->discount}}" discount-type="{{$item->discount_type}}" price="{{$item->price}}" value="{{$item->subcription_id}}">{{$item->subcription_id}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="coupon_code" class="form-label">Coupon Code</label>
                    <input type="text"  name="coupon_code" class="form-control" id="coupon_code">
                </div>
                <div class="col-3">
                    <label for="amount" class="form-label">Discount</label>
                    <input type="number" step="any"  name="amount" class="form-control" id="amount">
                </div>
                <div class="col-3">
                    <label for="discount_type" class="form-label">Discount Type</label>
                    <select  name="discount_type" class="form-control" id="discount_type">
                        <option value="">Select</option>
                        <option value="flat">Flat</option>
                        <option value="percentage">Percentage</option>
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

    $('#create-form #subcription_id').on('change', function (){
        let data = $('#subcription_id option:selected');
        let price = data.attr('price');
        let discount_type = data.attr('discount_type');
        let discount = data.attr('discount');
        let msg = '';
        if(data.val() != ""){
            msg = `Subscription price ${price} TK. ${discount > 0 ? 'It\'s have already discount '+discount+ (discount_type == "flat" ? "TK" : '%') + ' from price' : ''}`;
        }

        $('#createmodal #message').html(msg);

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
        await admin.post("{{route('coupon.save')}}", formData)
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
