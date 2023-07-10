<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ResponseController;
use App\Models\FilmIndustry;
use App\Models\HomeCategory;
use App\Models\MainCategory;
use App\Models\Movie;
use App\Models\VideoTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\MoviesParts;
use Illuminate\Validation\Rule;

class MoviesPartController extends Controller
{
    public function __construct()
    {
//        $this->path = env('');
    }

    function Page(Request $request){
        $movies = Movie::all();
        return view('pages.movies_part', compact('movies'));
    }

    function GetAll(Request $request){
        $data = DB::table('movies_part as mp')->
        join('movies as m', 'mp.movies_name', '=', 'm.name');
        if($request->get('movies_name')){
            $data = $data->where('mp.movies_name', $request->get('movies_name'));
        }
        if($request->get('play_mode')){
            $data = $data->where('mp.play_mode', $request->get('play_mode'));
        }

        $data = $data->select('mp.*',DB::raw("CONCAT('$this->path', m.tumbnail) as tumbnail") ,'m.display_name as movie_display_name')->
        get();
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
            'display_name' => [
                'required',
                Rule::unique('movies_part')->where(function ($query) use ($request){
                    return $query->where('movies_name', $request->movies_name)->where('display_name', $request->display_name);
                })
            ],
            'movies_name' => 'required',
            'play_mode' => 'required'
        ]);
        if($validate !== true){
            return $validate;
        }

        $image_1 = $request->file('image_1');
        $image_2 = $request->file('image_2');
        $image_3 = $request->file('image_3');
        $image_4 = $request->file('image_4');
        $thumbnail = $request->file('tumbnail');
        $video = $request->file('video');

        $path_in_movies = $request->movies_name."/".$request->display_name;
        $image_1_path = $this->_path($path_in_movies, $image_1, 'img1');
        $image_2_path = $this->_path($path_in_movies, $image_2, 'img2');
        $image_3_path = $this->_path($path_in_movies, $image_3, 'img3');
        $image_4_path = $this->_path($path_in_movies, $image_4, 'img4');
        $thumbnail_path = $this->_path($path_in_movies, $thumbnail, 'thm');
        $video_path = $this->_path($path_in_movies, $video, 'mov');

        $data = [
            'movies_name' => $request->movies_name,
            'name' => Str::slug($request->display_name),
            'display_name' => $request->display_name,
            'length' => $request->length,
            'play_mode' => $request->play_mode,
            'visibility' => $request->visibility,
            'imdb' => $request->imdb,
            'description' => $request->description,
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

        $res = MoviesParts::insert($data);
        if($res){
            return ResponseController::Reponse('Inserted Successfully');
        }
        else{
            File::delete([$image_1_path, $image_2_path, $image_3_path, $image_4_path, $video_path, $thumbnail_path]);
            return ResponseController::Reponse('Inserted Failed');
        }

    }

    function Update(Request $request){
        $validate = HelperController::Validator($request->all(), [
            'display_name' => 'required|unique:movies',
            'movies_name' => 'required',
            'play_mode' => 'required'
        ]);
        if($validate !== true){
            return $validate;
        }

        $image_1 = $request->file('image_1');
        $image_2 = $request->file('image_2');
        $image_3 = $request->file('image_3');
        $image_4 = $request->file('image_4');
        $thumbnail = $request->file('tumbnail');
        $video = $request->file('video');

        $path_in_movies = $request->movies_name."/".$request->display_name;
        $image_1_path = $this->_path($path_in_movies, $image_1, 'img1');
        $image_2_path = $this->_path($path_in_movies, $image_2, 'img2');
        $image_3_path = $this->_path($path_in_movies, $image_3, 'img3');
        $image_4_path = $this->_path($path_in_movies, $image_4, 'img4');
        $thumbnail_path = $this->_path($path_in_movies, $thumbnail, 'thm');
        $video_path = $this->_path($path_in_movies, $video, 'mov');

        $data = [
            'movies_name' => $request->movies_name,
            'name' => Str::slug($request->display_name),
            'display_name' => $request->display_name,
            'length' => $request->length,
            'play_mode' => $request->play_mode,
            'visibility' => $request->visibility,
            'imdb' => $request->imdb,
            'description' => $request->description,
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
        $res = MoviesParts::where('id', $request->input('id'))->update($data);
        if($res){
            return ResponseController::Reponse('Updated Successfully', 'false');
        }
        else{
            File::delete([$image_1_path, $image_2_path, $image_3_path, $image_4_path, $video_path, $thumbnail_path]);
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
