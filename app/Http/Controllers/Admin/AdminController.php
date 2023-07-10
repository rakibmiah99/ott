<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    function LoginPage(){
        return view('pages.login');
    }

    function Login(Request $request){
       $validate = HelperController::Validator($request->all(), [
           'email' => 'required',
           'password' => 'required'
       ]);

       if($validate !== true){
           return $validate;
       }

       if(Auth::guard('admin_auth')->attempt(['email' => $request->email, 'password' => $request->password])){
            $token = HelperController::GenerateToken($request);
            return [
                'status' => true,
                'message' => 'login successfully',
                'token' => $token
            ];
       }
       else{
           return [
               'status' => false,
               'message' => 'email or password did not match',
           ];
       }
    }
}
