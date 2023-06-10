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
                    <a class="nav-link active" data-bs-toggle="tab" href="#login">Join With Us</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-4 pb-4">
                <div class="tab-pane container active" id="login">
                    <form id="login-form">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                Mail
                            </span>
                            <input type="text" class="form-control" name="email" placeholder="example@mail.com">
                        </div>

                        <p class="text-danger text-center login-error-info"></p>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-50">Join</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('client.component.global.footer')
    @include('client.component.account.otp_modal')
    @include('client.layout.sidebar')
    @include('client.component.account.script')
@endsection

