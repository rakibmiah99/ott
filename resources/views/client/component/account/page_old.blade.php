@extends('client.layout.app')
@section('content')
    <div class="container-lg" id="top-menu">
        <div class="container-fluiddd">
            <div style="height: 60px" class="d-flex justify-content-center align-items-center pe-5 ps-5" id="top-menu-items">
                <div class="logo">
                    <h2 class="m-0 text-uppercase"><span class="text-dark">Bong</span><span style="color: var(--font-highlight)">TV</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container-lg mt-5 tabs"  style="max-width: 500px;margin: auto" >
        <div class="bg-white p-2" style="border-radius: 5px">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#signup">Signup</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-4 pb-4">
                <div class="tab-pane container active" id="login">
                    <form id="login-form">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <select style="background: transparent;border: none;outline:none;" name="cc">
                                    <option value="880">+880</option>
                                    <option>+1</option>
                                </select>
                            </span>
                            <input type="text" class="form-control" name="phone" placeholder="enter your phone number">

                        </div>

                        <p class="text-danger text-center login-error-info"></p>
                        <p class="text-dark text-center">If outside of bangladesh use another option</p>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-50">Login</button>
                        </div>
                    </form>
                    @include('client.component.account.another_process')
                </div>
                <div class="tab-pane container fade" id="signup">
                    <form id="signup-form">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <select style="background: transparent;border: none;outline:none;">
                                    <option>+880</option>
                                    <option>+1</option>
                                </select>
                            </span>
                            <input type="text" class="form-control" placeholder="enter your phone number">

                        </div>

                        <p class="text-dark text-center">If outside of bangladesh use another option</p>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-50">Signup</button>
                        </div>
                    </form>
                    @include('client.component.account.another_process')
                    <p class="text-dark text-center">By clicking Sign Up, you agree to our terms of use and privacy policy</p>
                </div>
            </div>
        </div>
    </div>
    @include('client.component.global.footer')
    @include('client.component.account.otp_modal')
    @include('client.layout.sidebar')
    @include('client.component.account.script')
@endsection

