<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use App\Models\FilmIndustry;

use App\Helper;
use Illuminate\Support\Str;

class FilmIndustryController extends Controller
{
    function Page(Request $request){
        return view('pages.film_industry');
    }


    function GetAll(Request $request){
        return FilmIndustry::get();
    }

    function GetSingle(Request $request){
        $id = $request->get('data-id');
        $data = FilmIndustry::where('id', $id)->get();
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
        $res = FilmIndustry::insert($request->all());
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
        $res = FilmIndustry::where('id', $request->id)->update($request->only(['name', 'display_name']));
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }



    function Delete(Request $request){
        $id = $request->get('data-id');
        $res = FilmIndustry::where('id', $id)->delete();
        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }

}
