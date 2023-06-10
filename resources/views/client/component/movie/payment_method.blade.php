<!--OTP Modal-->
<div class="modal" id="select-payment-method">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content" style="background: #b063d3e3;">

            <!-- Modal Header -->
            <div class="modal-header border-0">
                <button type="button" class="btn-close" style="background-color: var(--font-color); color: var(--font-highlight)" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body d-flex justify-content-center align-items-center">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-4 pt-2 pb-2" id="subscription-card">

                        </div>
                        <div class="col-1"></div>
                        <div class="col-7">
                            <input type="hidden" id="email">
                            <h6 class="lh-base">If have any coupon apply here </h6>
                            <div class="form-group d-flex justify-content-center align-items-center">
                                <input type="hidden" id="subscription-id-coupon-inp">
                                <input style="height: 40px" id="coupon-inp" type="text" class="form-control rounded-0 d-inline-block">
                                <button style="height: 40px" class="btn btn-primary w-50" id="coupon-apply-btn">APPLY</button>
                            </div>
                            <p class="mt-3 mb-3 coupon-message" style="color: #8d0404"></p>
                            <div class="d-flex flex-column mt-3">
                                <form id="bkash-form" method="post" action="{{route('user.payment')}}">
                                    @csrf
                                    <p class="mt-3">Bkash</p>
                                    <input type="hidden" name="subscription_id">
                                    <label class="w-100">
                                        <input type="radio" name="payment_method" class="me-3" value="bkash">
                                        <img src="{{asset('client_assets/img/bkash-logo.png')}}" height="70px">
                                        <div class="payment-gateway d-none mt-2">
                                            <button class="btn btn-primary w-50 rounded-pill mb-2" id="submit">Checkout</button>
                                        </div>
                                    </label>
                                </form>
                                <form id="cards-form" method="post" action="{{route('user.payment')}}">
                                    @csrf
                                    <p class="mt-3">Cards</p>
                                    <input type="hidden" name="subscription_id">
                                    <label class="mt-2 align-items-cente w-100r">
                                        <input type="radio" name="payment_method" class="me-3" value="ssl">
                                        <img src="{{asset('client_assets/img/bangladesh-cards.jpg')}}" height="40px">

                                        <div class="payment-gateway d-none mt-2">
                                            <input type="text" class="form-control w-100 rounded-0" placeholder="enter you mobile number with county code">
                                            <button class="btn mt-2 rounded-pill btn-primary w-50 mb-2" id="submit">Checkout</button>
                                        </div>
                                    </label>
                                </form>
                               {{-- <button class="btn btn-primary w-50 mb-2" id="submit">SUBMIT</button>
                                <button class=" btn btn-primary w-50" id="resend">RESEND CODE</button>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
