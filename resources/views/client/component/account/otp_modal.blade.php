<!--OTP Modal-->
<div class="modal" id="otp_modal">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content" style="background: #b063d3e3;">

            <!-- Modal Header -->
            <div class="modal-header border-0">
                <button type="button" class="btn-close" style="background-color: var(--font-color); color: var(--font-highlight)" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body d-flex justify-content-center align-items-center">
                <div style="width: 400px">
                    <input type="hidden" id="email">
                    <h6 class="text-center lh-base">Please enter the OTP code sent to your phone number <span id="show-email"></span></h6>
                    <div class="form-group text-center">
                        <input type="number" pos="1" class="otp-box-one form-control d-inline-block otp-box">
                        <input type="number" pos="2" class="otp-box-two form-control d-inline-block otp-box">
                        <input type="number" pos="3" class="otp-box-three form-control d-inline-block otp-box">
                        <input type="number" pos="4" class="otp-box-four form-control d-inline-block otp-box">
                    </div>
                    <p class="mt-3 mb-3 otp-error text-center" style="color: #8d0404"></p>
                    <div class="d-flex flex-column mt-3 text-center align-items-center">
                        <input type="hidden" id="action">
                        <button class="btn btn-primary w-50 mb-2" id="submit">SUBMIT</button>
                        <button class=" btn btn-primary w-50" id="resend">RESEND CODE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
