<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\Table;
use App\Models\HomeCategory;
use App\Models\HomeCategoryVisibility;
use App\Models\MainCategory;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HomeCategoryVisibilityController extends Controller
{


    function __construct()
    {
        $this->path = env('STORAGE_URL');
        $this->home_category_visibility =  DB::table(Table::HOME_CATEGORIES_VISIBILITY.' as hcv')->
        join(Table::HOME_CATEGORIES.' as hc', 'hcv.home_category_name', '=', 'hc.name')->
        join(Table::MOVIES.' as m', 'm.name' , '=', 'hcv.movie_name');
        $this->data_format = [
            'hcv.id',
            'hc.name as name',
            'hc.display_name as display_name',
            'm.name as movie_name',
            'm.display_name as movie_display_name',
            DB::raw("CONCAT('$this->path', m.tumbnail) as tumbnail")
        ];
    }

    function Page(Request $request){
        $home_category = HomeCategory::all();
        return view('pages.home_category_trending', compact('home_category'));
    }


    function GetAll(Request $request){
        $home_cat =  $request->get('home-category');
        $data = $this->home_category_visibility;
        if($home_cat){
            $data = $data->where('hc.name' ,'=', $home_cat)->orderBy('hcv.ordering', 'asc');
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
            'home_category_name' => 'required',
            'movie_name' => 'required|array'
        ]);

        if($validate !== true){
            return $validate;
        }

        $movies = [];
        foreach ($request->movie_name as $movie){
            $movies[] = [
                'home_category_name' => $request->home_category_name,
                'movie_name' => $movie
            ];
        }
        $res = HomeCategoryVisibility::insert($movies);
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
        $multiple= $request->get('multiple');

        $res = null;
        if($id){
            $res = HomeCategoryVisibility::where('id', $id)->delete();
        }
        else if($multiple){
            $ids = json_decode($multiple);
            $res = HomeCategoryVisibility::whereIn('id', $ids)->delete();
        }

        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }

    function Rearrange(Request $request){
        $home_cat = $request->get('home-category');
        $ids = $request->input('datas');
        $ids = json_decode($ids);
        try {
            foreach ($ids as $key=>$id){
                HomeCategoryVisibility::where('id', $id)->where('home_category_name', $home_cat)->update(['ordering' => $key]);
            }
            return ResponseController::Reponse('true', 'success');
        }
        catch (\Exception $e){
            return ResponseController::Reponse('true', 'error');
        }
    }
}
