<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Models\HomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeCategoryController extends Controller
{
    function Page(Request $request){
        return view('pages.home_categories');
    }


    function GetAll(Request $request){
        return HomeCategory::orderBy('ordering', 'asc')->get();
    }

    function GetSingle(Request $request){
        $id = $request->get('data-id');
        $data = HomeCategory::where('id', $id)->get();
        if($data->count() > 0){
            return $data->first();
        }
        else{
            return ResponseController::Reponse('false', 'data not found!');
        }
    }

    function Save(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'display_name' => 'required|unique:film_industries'
        ]);

        if($validate !== true){
            return $validate;
        }
        $request->merge(['name' => Str::slug($request->input('display_name'))]);
        $res = HomeCategory::insert($request->all());
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }

    function Update(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'id' => 'required|',
            'display_name' => 'required|unique:film_industries'
        ]);

        if($validate !== true){
            return $validate;
        }
        $request->merge(['name' => Str::slug($request->input('display_name'))]);
        $res = HomeCategory::where('id', $request->id)->update($request->only(['name', 'display_name']));
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }


    function Delete(Request $request){
        $id = $request->get('data-id');
        $res = HomeCategory::where('id', $id)->delete();
        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }

    function Rearrange(Request $request){
        $ids = $request->input('datas');
        $ids = json_decode($ids);
        try {
            foreach ($ids as $key=>$id){
                HomeCategory::where('id', $id)->update(['ordering' => $key]);
            }
            return ResponseController::Reponse('true', 'success');
        }
        catch (\Exception $e){
            return ResponseController::Reponse('true', 'error');
        }
    }
}
