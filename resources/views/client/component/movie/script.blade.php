<script>
    client.get('/subscription')
    .then(function (response){
        if(response.status === 200){
            let data = response.data;
            let el = $('#subscribe-item-container');
            el.empty();
            if(data.length > 0){
                data.forEach(function (item){
                   template(el, item)
                });
            }
        }
    })
    .catch(function (error){
        console.log(error)

    })

    $('#subscribe-item-container').on('click', '.buy-now-btn', function (e){
        let subscription_id = $(this).attr('subscription-id');
        client.get('/subscription/'+subscription_id)
        .then(function (response){
            if(response.status === 200){
                let data = response.data;
                let el = $('#subscription-card');
                el.empty();
                if(data != '' || data != null){
                    $('#subscription-id-coupon-inp').val(subscription_id);
                    $('#select-payment-method').modal('show');
                    template_for_modal(el, data);
                }
            }
        })
        .catch(function (error){
            AxiosErrorHandle(error)
        })

    })


    //coupon validation
    $('#coupon-apply-btn').on('click', function (){
        let coupon_message = $('.coupon-message');
        let el = $('#subscription-card');
        coupon_message.empty();
        let subscription_id = $('#subscription-id-coupon-inp').val();
        let coupon = $('#coupon-inp').val();
        if(coupon == ""){
            return false;
        }
        client.get('/apply-coupon/'+subscription_id+"/"+coupon)
        .then(function (response){
            let data = response.data;
            el.empty();
            if(data != '' || data != null){
                coupon_message.html(`<span class="bg-success text-white p-2">${data.message}</span>`);
                $('#subscription-id-coupon-inp').val(subscription_id);
                $('#select-payment-method').modal('show');
                template_for_modal(el, data);
            }
        })
        .catch(function (error){
            console.log(error);
            if(error.response){
                let response = error.response;
                if(response.status === 404){
                    let data = response.data
                    coupon_message.html(`<span class="bg-danger text-white p-2">${data.message}</span>`);
                    el.empty();
                    if(data.restore_data != '' || data.restore_data != null){
                        $('#subscription-id-coupon-inp').val(subscription_id);
                        $('#select-payment-method').modal('show');
                        template_for_modal(el, data.restore_data);
                    }
                }
            }
        })
    })



    function template_for_modal(el, item){
        $('input[name=subscription_id]').val(item.subscription_name)
        el.append(`
            <div class="card subscription-card text-dark">
                    <div class="card-header">
                        <h5 class="text-center p-2 m-0 ">${item.subscription_name}</h5>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center">
                            ${
                                item.old_price_visibility == true ?
                                `<h5 class="me-3 text-muted"><del>${item.old_price}</del></h5> <h2>${item.current_price}</h2>` :
                                `<h2>${item.current_price}</h2>`
                            }
                        </div>
                        <p class="text-capitalize">add free premium access</p>
                        <p class="text-capitalize">${item.device} device login</p>
                        <p class="text-capitalize">${item.simulation} simulation stream</p>

                    </div>
                </div>
        `)
    }

    function template(el, item){
        el.append(`
            <div class="col-4 pt-2 pb-2">
                <div class="card subscription-card text-dark">
                    <div class="card-header">
                        <h5 class="text-center p-2 m-0 ">${item.subscription_name}</h5>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center">
                            ${
                                item.old_price_visibility == true ?
                                `<h5 class="me-3 text-muted"><del>${item.old_price}</del></h5> <h2>${item.current_price}</h2>` :
                                `<h2>${item.current_price}</h2>`
                            }
                        </div>
                        <p class="text-capitalize">add free premium access</p>
                        <p class="text-capitalize">${item.device} device login</p>
                        <p class="text-capitalize">${item.simulation} simulation stream</p>
                        <button subscription-id="${item.subscription_name}" class="btn buy-now-btn btn-highlight">Buy Now</button>
                    </div>
                </div>
            </div>
        `)
    }
</script>
