<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Models\FilmIndustry;
use App\Models\HomeCategory;
use App\Models\HomeCategoryVisibility;
use App\Models\FeatureMovies;
use App\Models\MainCategory;
use App\Models\Movie;
use App\Models\VideoTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MoviesController extends Controller
{
    public function __construct()
    {
        $this->path = asset('');
    }

    function Page(Request $request){
        $categories = MainCategory::all();
        $industries = FilmIndustry::all();
        $video_types = VideoTypes::all();
        $home_categories = HomeCategory::all();
        return view('pages.movies', compact('categories', 'industries', 'video_types', 'home_categories'));
    }

//home_category_name=movies-you-must-watch
   function GetSelectable(Request $request){
        $category =  $request->get('category');
        $sub_category = $request->get('sub_category');
        $home_cat = $request->get('home_category_name');
        if($home_cat){
            $movies = HomeCategoryVisibility::where('home_category_name', $home_cat)->pluck('movie_name');
            return Movie::whereNotIn('name', $movies)->get(['name', 'display_name']);
        }
        //Start Get Feature Selectable Movie
        else if($category && !$sub_category && $category){
            $exist_movie = FeatureMovies::where('category', $category)->pluck('movie_name');
            if ($category == 'home'){
                return Movie::whereNotIn('name', $exist_movie)->
                get(['name', 'display_name']);
            }
            else{
                return Movie::whereNotIn('name', $exist_movie)->
                where('category_name', $category)->
                get(['name', 'display_name']);
            }

        }
        else if($category && $sub_category){
            $exist_movie = FeatureMovies::where('category', $category)->where('sub_category', $sub_category)->pluck('movie_name');
            return Movie::whereNotIn('name', $exist_movie)->
                where('category_name', $category)->
                where('sub_category_name', $sub_category)->
                get(['name', 'display_name']);
        }
        else{
            return ResponseController::Reponse('Payload Error', 444);
        }


   }

    function GetAll(Request $request){
        $data = DB::table('movies as m')->
            leftJoin('main_category as c', 'm.category_name' , '=', 'c.name')->
            leftJoin('sub_category as sc' , function ($join){
                $join->on('m.sub_category_name', '=', 'sc.name');
                $join->on('m.category_name', '=', 'sc.main_category_name');
            })->
            leftJoin('film_industries as f', 'm.film_industries_name', '=', 'f.name')->
            leftJoin('home_categories as hc', 'm.home_category_name', '=', 'hc.name');

            if($request->get('category_name') ){
                $data = $data->where('m.category_name', $request->get('category_name'));
            }
            if($request->get('sub_category_name')){
                $data = $data->where('m.sub_category_name', $request->get('sub_category_name'));
            }
            if($request->get('play_mode')){
                $data = $data->where('m.play_mode', $request->get('play_mode'));
            }
            if($request->get('film_industries_name')){
                $data = $data->where('m.film_industries_name', $request->get('film_industries_name'));
            }
            if($request->get('home_category_name')){
                $data = $data->where('m.home_category_name', $request->get('home_category_name'));
            }


         $data = $data->get([
                'm.id as id',
                'm.name',
                'm.display_name',
                'c.display_name as category',
                'sc.display_name as sub_category',
                'f.display_name as film_industry',
                'hc.display_name as home_category',
                'video_type_name as video_type',
                'm.visibility',
                DB::raw("CONCAT('$this->path', m.tumbnail) as tumbnail")
            ]);

        return $data;
    }

    function GetSingle(Request $request){
        $id = $request->get('data-id');
        $data = Movie::where('id', $id)->get([
            'id',
            'name',
            'display_name',
            'length',
            DB::raw("concat('$this->path', tumbnail) as tumbnail"),
            DB::raw("concat('$this->path', image_1) as image_1"),
            DB::raw("concat('$this->path', image_2) as image_2"),
            DB::raw("concat('$this->path', image_3) as image_3"),
            DB::raw("concat('$this->path', image_4) as image_4"),
            DB::raw("concat('$this->path', trailler) as trailler"),
            DB::raw("concat('$this->path', video) as video"),
            'description',
            'imdb',
            'visibility',
            'play_mode',
            'category_name',
            'sub_category_name',
            'film_industries_name',
            'video_type_name',
            'home_category_name',
        ]);
        if($data->count() > 0){
            return $data->first();
        }
        else{
            return ResponseController::Reponse('false', 'data not found!');
        }
    }

    function Save(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'display_name' => 'required|unique:movies',
            'sub_category_name' => 'required',
            'film_industries_name' => 'required',
            'video_type_name' => 'required',
        ]);
        if($validate !== true){
            return $validate;
        }

        $image_1 = $request->file('image_1');
        $image_2 = $request->file('image_2');
        $image_3 = $request->file('image_3');
        $image_4 = $request->file('image_4');
        $thumbnail = $request->file('tumbnail');
        $trailer = $request->file('trailer');
        $video = $request->file('video');

        $image_1_path = $this->_path($request->display_name, $image_1, 'img1');
        $image_2_path = $this->_path($request->display_name, $image_2, 'img2');
        $image_3_path = $this->_path($request->display_name, $image_3, 'img3');
        $image_4_path = $this->_path($request->display_name, $image_4, 'img4');
        $thumbnail_path = $this->_path($request->display_name, $thumbnail, 'thm');
        $video_path = $this->_path($request->display_name, $video, 'mov');
        $trailer_path = $this->_path($request->display_name, $trailer, 'trlr');

        $data = [
            'name' => Str::slug($request->display_name),
            'display_name' => $request->display_name,
            'length' => $request->length,
            'play_mode' => $request->play_mode,
            'visibility' => $request->visibility,
            'imdb' => $request->imdb,
            'category_name' => $request->category_name,
            'sub_category_name' => $request->sub_category_name,
            'film_industries_name' => $request->film_industries_name,
            'video_type_name' => $request->video_type_name,
            'home_category_name' => $request->home_category_name,
            'description' => $request->description,
            'image_1' => $image_1_path,
            'image_2' => $image_2_path,
            'image_3' => $image_3_path,
            'image_4' => $image_4_path,
            'tumbnail' => $thumbnail_path,
            'video' => $video_path,
            'trailler' => $trailer_path
        ];

        $res = Movie::insert($data);
        if($res){
            return ResponseController::Reponse('Inserted Successfully');
        }
        else{
            File::delete([$image_1_path, $image_2_path, $image_3_path, $image_4_path, $video_path, $trailer_path, $thumbnail_path]);
            return ResponseController::Reponse('Inserted Failed');
        }

    }

    function Update(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'display_name' => 'required',
//            'category_name ' => 'required',
            'sub_category_name' => 'required',
            'film_industries_name' => 'required',
            'video_type_name' => 'required',
        ]);
        if($validate !== true){
            return $validate;
        }

        $image_1 = $request->file('image_1');
        $image_2 = $request->file('image_2');
        $image_3 = $request->file('image_3');
        $image_4 = $request->file('image_4');
        $thumbnail = $request->file('tumbnail');
        $trailer = $request->file('trailer');
        $video = $request->file('video');

        $image_1_path = $this->_path($request->display_name, $image_1, 'img1');
        $image_2_path = $this->_path($request->display_name, $image_2, 'img2');
        $image_3_path = $this->_path($request->display_name, $image_3, 'img3');
        $image_4_path = $this->_path($request->display_name, $image_4, 'img4');
        $thumbnail_path = $this->_path($request->display_name, $thumbnail, 'thm');
        $video_path = $this->_path($request->display_name, $video, 'mov');
        $trailer_path = $this->_path($request->display_name, $trailer, 'trlr');

        $data = [
            'name' => Str::slug($request->display_name),
            'display_name' => $request->display_name,
            'length' => $request->length,
            'play_mode' => $request->play_mode,
            'visibility' => $request->visibility,
            'imdb' => $request->imdb,
            'category_name' => $request->category_name,
            'sub_category_name' => $request->sub_category_name,
            'film_industries_name' => $request->film_industries_name,
            'video_type_name' => $request->video_type_name,
            'home_category_name' => $request->home_category_name,
//            'description' => $request->description,
        ];


        if($image_1){
            $data['image_1'] = $image_1_path;
        }
        if($image_2){
            $data['image_1'] = $image_2_path;
        }
        if($image_3){
            $data['image_3'] = $image_3_path;
        }
        if($image_4){
            $data['image_4'] = $image_4_path;
        }
        if($thumbnail){
            $data['tumbnail'] = $thumbnail_path;
        }
        if($video){
            $data['video'] = $video_path;
        }
        if($trailer){
            $data['trailler'] = $trailer_path;
        }



        $res = Movie::where('id', $request->input('id'))->update($data);

        if($res){
            return ResponseController::Reponse('Updated Successfully', 'false');
        }
        else{
            File::delete([$image_1_path, $image_2_path, $image_3_path, $image_4_path, $video_path, $trailer_path, $thumbnail_path]);
            return ResponseController::Reponse('Updated Failed');
        }
    }



    function Delete(Request $request){
        $id = $request->get('data-id');
        $res = Movie::where('id', $id)->delete();
        if ($res){
            return ResponseController::Reponse('Deleted Successfully', 'true');
        }
        else{
            return ResponseController::Reponse('Deleted Failed', 'false');
        }
    }



    function _path($movie_name, $file, $prefix){
        $path = HelperController::UploadPath($movie_name);
        return HelperController::FileUpload($file, $path, $prefix)->path;
    }
}
