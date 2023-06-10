<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Models\FilmIndustry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SubscriptionPlan;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    function Page(Request $request){
        return view('pages.subscription_plan');
    }


    function GetAll(Request $request){
        return SubscriptionPlan::get();
    }

    function GetSingle(Request $request){
        $id = $request->get('data-id');
        $data = SubscriptionPlan::where('id', $id)->get();
        if($data->count() > 0){
            return $data->first();
        }
        else{
            return ResponseController::Reponse('false', 'data not found!');
        }
    }

    function Save(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'subcription_id' => 'required|unique:subscription_plain',
            'price' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);

        if($validate !== true){
            return $validate;
        }
        $res = SubscriptionPlan::insert($request->all());
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }

    function Update(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'subcription_id' =>'required',
            'price' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);

        if($validate !== true){
            return $validate;
        }
        $res = SubscriptionPlan::where('id', $request->id)->update($request->except(['id']));
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }



    function Delete(Request $request){
        $id = $request->get('data-id');
        $res = SubscriptionPlan::where('id', $id)->delete();
        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }
}
