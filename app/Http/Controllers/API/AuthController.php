<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function Page(){
        return view('client.component.account.page');
    }

    function Login(Request $request){
        $email = $request->input('email');
        $user = User::where('email', '=', $email)->get();
        if($user->isNotEmpty()){
            return ResponseController::Reponse('User Found');
        }
        else{
            User::insert([
                'email' => $email
            ]);
            OTP::insert([
               'email' => $email,
               'request_for' => 'login',
                'code' => '1234'
            ]);
            return ResponseController::Reponse('User Created');
//            return ResponseController::Reponse('you have no account. please signup', false);
        }
    }

    function LoginWithOtp(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');
        $get_otp = OTP::where('email', '=', $email)->latest('code')->first(['code']);

        if($get_otp->code == $otp){
            $user = User::where('email', '=', $email)->first();
            $token = $user->createToken($user->email)->plainTextToken;
            $request->session()->put('_user_token' , $token);
            return response([
                'message' => 'login successfully',
                'token' => $token,
                'status' => true
            ]);
        }
        else{
            return ResponseController::Reponse('otp is incorrect. try again', false);
        }
    }

}
