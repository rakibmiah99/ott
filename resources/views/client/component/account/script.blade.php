<script>
    $('#login-form').on('submit', loginFunction)
    function loginFunction(e){
        e.preventDefault();
        let email = $('#login-form input[name=email]').val();
        let form_data = new FormData();
        form_data.append('email', email);
        client.post('/login', form_data)
        .then(function (response){
            if(response.status === 200){
                let data = response.data;
                if(data.status == true){
                    $('#otp_modal #show-email').html(email);
                    $('#otp_modal #email').val(email);
                    $("#otp_modal #action").val('login');
                    $('.login-error-info').empty();
                    $("#otp_modal").modal('show');
                }
                else{
                    $('.login-error-info').html(data.message)
                }
            }
        })
        .catch(function (error){
            console.log(error)
        })
    }

    //Jumb Next OTP Box IF Given Any Number
    $('.otp-box').on('keyup change', function (e){
        let value = $(this).val();
        let pos = Number($(this).attr('pos'));
        if(value >= 0 && value < 10){
            if(value != ""){
                changePos();
            }
        }
        else{
            changePos();
            let new_value = value[value.length - 1];
            $(this).val(new_value)
        }


        function changePos(){
            if(pos < 5){
                let change_pos = pos + 1;
                console.log(change_pos)
                $(`input[pos=${change_pos}]`).trigger('focus')
            }
        }
    })


    //Check OTP
    $('#submit').on('click', function (){
        let action = $('#otp_modal #action').val();
        let d1 = $('#otp_modal .otp-box-one').val();
        let d2 = $('#otp_modal .otp-box-two').val();
        let d3 = $('#otp_modal .otp-box-three').val();
        let d4 = $('#otp_modal .otp-box-four').val();
        let otp = Number(d1+d2+d3+d4);
        let email = $('#otp_modal #email').val();

        if(action == "login"){
            let form_data = new FormData();
            form_data.append('email', email);
            form_data.append('otp', otp);
            client.post('/login-with-otp', form_data)
            .then(function (response){
               if(response.status == 200){
                   let data = response.data;
                   if(data.status == true){
                       $('.otp-error').empty();
                       setToken(data.token);
                       redirectUrl();
                   }
                   else{
                       $('.otp-error').html(data.message);
                   }
               }
            })
            .catch(function (error){
                console.log(error)
            })
        }
    })


</script>
