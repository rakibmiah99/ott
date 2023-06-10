<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionCoupons;
use Illuminate\Http\Request;

class SubscriptionCouponController extends Controller
{
    function Page(Request $request){
        $subscription_plan = SubscriptionPlan::get();
        return view('pages.subscription_coupon', compact('subscription_plan'));
    }


    function GetAll(Request $request){
        return SubscriptionCoupons::get();
    }

    function GetSingle(Request $request){
        $id = $request->get('data-id');
        $data = SubscriptionCoupons::where('id', $id)->get();
        if($data->count() > 0){
            return $data->first();
        }
        else{
            return ResponseController::Reponse('false', 'data not found!');
        }
    }

    function Save(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'subcription_id' => 'required',
            'coupon_code' => 'required',
            'amount' => 'required',
            'discount_type' => 'required',
        ]);

        if($validate !== true){
            return $validate;
        }
        $res = SubscriptionCoupons::insert($request->all());
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }

    function Update(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'subcription_id' => 'required',
            'coupon_code' => 'required',
            'amount' => 'required',
            'discount_type' => 'required',
        ]);

        if($validate !== true){
            return $validate;
        }
        $res = SubscriptionCoupons::where('id', $request->id)->update($request->except(['id']));
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }



    function Delete(Request $request){
        $id = $request->get('data-id');
        $res = SubscriptionCoupons::where('id', $id)->delete();
        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }

}
