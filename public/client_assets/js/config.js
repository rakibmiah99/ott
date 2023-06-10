let home_url = "http://127.0.0.1:8000";
let client = axios.create({
    baseURL: "http://127.0.0.1:8000/api",
    headers: {'Authorization': getToken()}
})

function getToken(){
    return 'Bearer '+localStorage.getItem('client_token');
}

function setToken(token){
    localStorage.setItem('client_token', token);
}
function removeToken(){
    localStorage.removeItem('client_token');
}

function setUrl(url){
    let obj = {
        prevUrl: url.split('#')[0]
    }
    localStorage.setItem('url', JSON.stringify(obj));
}
function getUrl(){
    let urls = localStorage.getItem('url');
    if(urls == null){
        urls = JSON.stringify({
            prevUrl: home_url
        })
    }
    return JSON.parse(urls);
}

function redirectToLogin(){
    setUrl(window.location.href);
    window.location.href = home_url+"/account";
}

function redirectUrl(){
    if(getUrl().prevUrl == "" || getUrl().prevUrl == null){
        window.location.href = home_url;
    }
    else{
        return window.location.href = getUrl().prevUrl;
    }
}

function logout(){
    removeToken();
    setUrl(window.location.href);
    redirectUrl();
}

function AxiosErrorHandle(error){
    console.log(error.response)
    if(error.response){
        let response = error.response;
        if(response.status === 401){
            redirectToLogin();
        }
    }
}
