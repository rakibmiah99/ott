let base_url = 'http://127.0.0.1:8000/api/admin';
let redirect_to_login = 'http://127.0.0.1:8000/login'
const admin_auth = axios.create({
    baseURL: base_url
});

let admin = axios.create({
    baseURL: base_url,
})
admin.defaults.headers.common['Authorization'] = "Bearer "+  GetToken();

function AxiosErrorHandle(error, formEl){
    PreloaderOff();
    ModalLoadingOff();
    if(typeof(error.response) != "undefined" || typeof(error.response) != undefined){
        let err = error.response;
        let data = error.response.data;

        if(err.status == 422){
            if('errors' in data){
                let inp_errors = data.errors;
                let input_names = Object.keys(inp_errors);
                input_names.forEach(function (item){
                    ToastError(inp_errors[item]);
                    $(`${formEl} input[name=${item}]`).addClass('border border-danger')
                    $(`${formEl} input[name=${item}]`).trigger('focus');
                })
            }
        }
        else if(err.status == 401){
            ToastError(err.message);
            window.location.href = redirect_to_login;
        }
    }

}

function PreloaderOn(){
    $('#preloader').removeClass('d-none');
}

function PreloaderOff(){
    $('#preloader').addClass('d-none');
}

function ModalLoadingOn(){
    $('#modal-loading').removeClass('d-none')
}

function ModalLoadingOff(){
    $('#modal-loading').addClass('d-none')
}

function ToastError(msg){
    toastr["error"](msg)
}

function ToastSuccess(msg){
    toastr["success"](msg)
}

function RemoveErrorBorder(selector){
    selector.find('input').removeClass('border border-danger')
}

function ModalClose(){
    // $('.btn-close').trigger('click');
    $('.modal-close').trigger('click');
    $('button[data-bs-dismiss=modal]').trigger('click');
}

function formData(form){
    let get_form = form.serializeArray();
    let formData = new FormData();
    get_form.forEach(function (item){
        formData.append(item.name, item.value);
    })
    return formData;
}

function SetToken(token){
    sessionStorage.setItem('__token', token)
}

function GetToken(){
    return sessionStorage.getItem('__token')
}

function orderData(el){
    let tr = el;
    let items = [];
    for(let i =0;i < tr.length ; i++){
        let data_id = tr[i].getAttribute('data-id');
        items.push(Number(data_id))
    }
    return items;
}

function SaveOrder(el,url, load_func,param = ''){
    PreloaderOn();
    ModalClose();
    let formData = new FormData();
    let order_data = '';
    formData.append('datas', JSON.stringify(orderData(el)));
    admin.post(url, formData)
    .then(function (response){
        if(response.status == 200){
            let data = response.data;
            ToastSuccess(data.message);
            load_func(param);
        }
    })
    .catch(function (error){
        AxiosErrorHandle(error);
    })
}

function fileValidation(file, accept_extension = [], label='', accept_size = 100000000000){

    if(typeof(file) === undefined || typeof(file) === "undefined") {

    }
    else{
        let file_original_name = file.name;
        let file_split = file_original_name.split('.');
        let extension = file_split[file_split.length - 1];
        let file_type = file.type;
        let size = file.size;
        if (accept_size < size) {
            ToastError(label + ' file size too large')
            return false;
        } else if (accept_extension.length > 0) {
            let found = false;
            accept_extension.forEach(function (item) {
                if (item == extension) {
                    found = true;
                    return file;
                }
            });

            if (found == false) {
                console.log('found ' + found);
                ToastError(label + 'file type can  only support ' + accept_extension.join());
                return false;
            }
        } else {
            ToastError('this function accept at least one validation extension');
        }
    }

}
