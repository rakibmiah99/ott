
@extends('layout.app')
@section('no-sidebar', 'dd')

@section('main-content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <span class="bongTVLogo d-none d-lg-block">Bong<span class="text-primary fw-bold">TV</span></span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your email & password to login</p>
                                </div>

                                <form class="row g-3" id="loginValidate" >
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="example@mail.com" id="email" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" placeholder="*****" class="form-control" id="yourPassword" required>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script>
        $('#loginValidate').on('submit', function(e){
            e.preventDefault();
            admin_auth.post('/account/login', formData($(this)))
            .then(function (response){
                if(response.status === 200){
                    let data = response.data;
                    if(data.status == true){
                        ToastSuccess(data.message);
                        SetToken(data.token);
                        window.location.href = "{{route('dashboard')}}";
                    }
                    else{
                        ToastError(data.message)
                    }
                }
            })
            .catch(function (error){
                AxiosErrorHandle(error, $('#loginValidate'))
            })
        })

    </script>
@endsection

