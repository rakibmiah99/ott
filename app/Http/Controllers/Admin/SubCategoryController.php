<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Models\MainCategory;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Table;
class SubCategoryController extends Controller
{

    function __construct()
    {
        $this->sub_category =  DB::table(Table::SUB_CATEGORY.' as sub')->
        join(Table::MAIN_CATEGORY.' as main', 'sub.main_category_name', '=', 'main.name');
        $this->data_format = [
            'sub.id',
            'main.name as main_category_name',
            'main.display_name as mc_display_name',
            'sub.name',
            'sub.display_name'
        ];
    }

    function Page(Request $request){
        $main_category = MainCategory::all();
        return view('pages.sub_category', compact('main_category'));
    }


    function GetAll(Request $request){

       $main_cat =  $request->get('main-category');
        $data = $this->sub_category;
        if($main_cat){
            $data = $data->where('sub.main_category_name' ,'=', $main_cat);
        }
       return $data->get($this->data_format);
    }

    function GetSingle(Request $request){
        $id = $request->get('data-id');
        $data = $this->sub_category->where('sub.id', $id)->get($this->data_format);
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
        $res = SubCategories::insert($request->all());
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
        $res = SubCategories::where('id', $request->id)->update($request->only(['name', 'display_name']));
        if ($res){
            return ResponseController::Reponse('Inserted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Inserted Failed', 'false');
        }
    }



    function Delete(Request $request){
        $id = $request->get('data-id');
        $res = SubCategories::where('id', $id)->delete();
        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }
}
