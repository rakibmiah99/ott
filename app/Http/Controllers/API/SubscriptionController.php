<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionCoupons;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    function Page(){
        return view('client.component.subscribe.page');
    }

    function SubscriptionData($subscription_id = false){
        $query =  SubscriptionPlan::query();
        if($subscription_id){
            $query = $query->where('subcription_id', '=', $subscription_id);
        }
        return $query->get([
            'subcription_id as subscription_name',
            DB::raw("IF(discount > 0, price, '0') as old_price"),
            DB::raw("IF(discount > 0, IF(discount_type = 'flat', (price - discount), price - (price * discount)/100) ,price) as current_price"),
            'number_of_device as device',
            'number_of_simulation as simulation',
            'currency',
            'currency_position'
        ]);
    }

    function Get($subscription_id = false){
        return $this->SubscriptionData($subscription_id)->map(function ($item){
            $currency = $item->currency;
            $position = $item->currency_position;
            $item->old_price_visibility = ($item->old_price > 0) ? true : false;
            $item->old_price = $this->currencyPosition($position, $currency, $item->old_price);
            $item->current_price = $this->currencyPosition($position, $currency, $item->current_price);
            unset($item->currency);
            unset($item->currency_position);
            return $item;
        });
    }

    function GetSingle(Request $request){
        return $this->Get($request->subscription_id)->first();
    }

    function ApplyCoupon(Request $request){
        $coupon = $request->coupon;
        $subscription_id = $request->subscription_id;
        $coupon_db = SubscriptionCoupons::where('subcription_id', $subscription_id)->where('coupon_code', $coupon);
        $coupon_data = null;
        if($coupon_db->count() > 0){
            $coupon_data = $coupon_db->first(['discount_type', 'amount']);
        }
        else{
            return response([
                'restore_data' => $this->GetSingle($request),
                'status' => false,
                'message' => "Coupon not found"
            ], 404);
        }

        return $this->SubscriptionData($subscription_id)->map(function ($item) use ($coupon_data){
            $currency = $item->currency;
            $position = $item->currency_position;
            $coupon_discount = $coupon_data->amount;
            if($coupon_data->discount_type == 'percent'){
                $coupon_discount = $item->current_price - ($item->current_price * $coupon_data->amount) / 100;
            }
            $item->old_price_visibility = ($item->old_price > 0) ? true : false;
            $item->coupon_discount = $this->currencyPosition($position, $currency, $coupon_discount);
            $item->old_price = $this->currencyPosition($position, $currency, $item->old_price);
            $item->current_price = $this->currencyPosition($position, $currency, $item->current_price - $coupon_discount);
            $item->message = "congratulation! you got discount ".$item->coupon_discount;
            unset($item->currency);
            unset($item->currency_position);
            return $item;
        })->first();
    }

    function currencyPosition($position, $currency, $amount):string{
        return ($position == "before") ? $currency.$amount : $amount.$currency;
    }
}
