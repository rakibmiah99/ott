<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CurrentSubscription;
use App\Models\SubscriptionBuyHistory;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class PaymentController extends Controller
{
    function PaymentProcess(Request $request){
        $user = $this->user($request);
        $subscription_id = $request->subscription_id;
        $subscription_plan = SubscriptionPlan::where('subcription_id', $subscription_id)->get();
        if($subscription_plan->isNotEmpty()){
            $subscription_plan = $subscription_plan->first();
            $buy_date = date('Y-m-d');
            $number_of_days_of_plan = ($subscription_plan->duration_year * 365) + ($subscription_plan->duration_month * 31) + $subscription_plan->duration_day;
            $expire_date = date('Y-m-d', strtotime( "$number_of_days_of_plan days"));
            $price = $this->Price($subscription_plan->price, $subscription_plan->discount, $subscription_plan->discount_type);

            DB::beginTransaction();
            try{
                $subscription_buy_id = DB::table('subscription_buy_history')->insertGetId([
                    'user_id' => $user->id,
                    'subcription_id' => $subscription_id,
                    'price' => $price,
                    'buy_date' => $buy_date,
                    'expire_date' => $expire_date,
                ]);

                $criteria = ['user_id' => $user->id];
                DB::table('current_subcription')->updateOrInsert($criteria, [
                    'subscription_history_id' => $subscription_buy_id
                ]);
                DB::commit();
                return redirect()->route('user.home');
            }
            catch (\Exception $e){
                DB::rollBack();
                return $e->getMessage();
            }

        }
        return $request->all();
    }


    function user(Request $request){
        $get_token = $request->session()->get('_user_token');
        $token = PersonalAccessToken::findToken($get_token);
        return $user = $token->tokenable;
    }

    function Price($total, $discount, $discount_type): float{
        if($discount_type == "flat"){
            $current_price = $total - $discount;
        }
        else if($discount_type == "percent"){
            $discount_amount = ($total * $discount ) / 100;
            $current_price = $total - $discount_amount;
        }
        else{
            $current_price =  $total;
        }
        return $current_price;
    }
}
