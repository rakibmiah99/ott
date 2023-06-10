<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\Table;
use App\Models\HomeCategory;
use App\Models\HomeCategoryVisibility;
use App\Models\FeatureMovies;
use App\Models\MainCategory;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeatureMoviesController extends Controller
{
    function __construct()
    {
        $this->path = env('STORAGE_URL');
        $this->feature_movies =  DB::table(Table::FEATURE_MOVIES.' as f')->
        leftJoin(Table::MAIN_CATEGORY.' as c', 'f.category', '=', 'c.name')->
        leftJoin(Table::SUB_CATEGORY.' as sc', function ($join){
            $join->on('f.sub_category', '=', 'sc.name');
            $join->on('f.category', '=', 'sc.main_category_name');
        })->
        join(Table::MOVIES.' as m', 'm.name' , '=', 'f.movie_name');
        $this->data_format = [
            'f.id',
            'c.display_name as category',
//            'sc.display_name as sub_category',
            DB::raw("ifNull(sc.display_name, '-')  as sub_category"),
            'm.name as movie_name',
            'm.display_name as movie_display_name',
            DB::raw("CONCAT('$this->path', m.tumbnail) as tumbnail")
        ];
    }

    function Page(Request $request){
        $home_category = HomeCategory::all();
        $category = MainCategory::all();
        return view('pages.feature_movies', compact('home_category', 'category'));
    }


    function GetAll(Request $request){
        $cat =  $request->get('category');
        $sub_cat =  $request->get('sub_category');
        $data = $this->feature_movies;
//        $data = $data->where('f.category', '=', 'movies')->where('f.sub_category', '=', 'action');
        if($cat && !$sub_cat){
                $data = $data->where('f.category', '=', $cat)->where('f.sub_category', '=', null);
        }
        if($sub_cat){
            $data = $data->where('f.sub_category', '=', $sub_cat);
        }

        $data = $data->orderBy('f.ordering', 'asc');

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
            'category' => 'required',
            'movie_name' => 'required|array'
        ]);

        if($validate !== true){
            return $validate;
        }


        $movies = [];
        foreach ($request->movie_name as $movie){
            $movies[] = [
                'category' => $request->category,
                'sub_category' => $request->sub_category,
                'movie_name' => $movie
            ];
        }
        $res = FeatureMovies::insert($movies);
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
            $res = FeatureMovies::where('id', $id)->delete();
        }
        else if($multiple){
            $ids = json_decode($multiple);
            $res = FeatureMovies::whereIn('id', $ids)->delete();
        }

        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }

    function Rearrange(Request $request){
        $cat =  $request->get('category');
        $sub_cat =  $request->get('sub_category');
        $ids = $request->input('datas');
        $ids = json_decode($ids);
        try {
            foreach ($ids as $key=>$id){
                FeatureMovies::where('id', $id)->update(['ordering' => $key]);
            }
            return ResponseController::Reponse('true', 'success');
        }
        catch (\Exception $e){
            return ResponseController::Reponse($e->getMessage(), 'error');
        }
    }
}
