<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\Table;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalController extends Controller
{
    function GetMenu(Request $request){
        $user_id = auth('sanctum')->id();
        $menu =  MainCategory::find('movies')->with('sub_category:main_category_name,name,display_name')->orderBy('name')->get(['name', 'display_name']);
        $current_subscription = HelperController::CurrentSubscription($user_id);
        $today = Date('Y-m-d');
        $expire_date = ($current_subscription) ?  $current_subscription->expire_date : date('Y-m-d', strtotime('-1 days'));
        $subscription_visibility = true;
        if($expire_date > $today){
            $subscription_visibility = false;
        }


        $data = [
            'menu' => $menu,
            'subscription_visibility' => $subscription_visibility
        ];
        return HelperController::ViewerResponse($data);
    }
}
