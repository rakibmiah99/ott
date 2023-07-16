<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\HomeCategory;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->path = env('/');
    }
    //
    function CategoryPage(){

        return view('client.component.category.category');
    }


    function FirstLoad(Request $request){
        $name = $request->path();
        /*return auth('sanctum')->user();*/
        $feature = DB::table(Table::FEATURE_MOVIES.' as f')->
        join(Table::MOVIES.' as m' ,'f.movie_name', '=', 'm.name')->
        where('m.visibility', '=', 1)->
        get([
            'm.name',
            'm.display_name',
            'm.length',
            'm.description',
            'm.imdb',
            'm.play_mode',
            DB::raw("if(image_1 = '', '', CONCAT('$this->path', m.image_1)) as banner")
        ]);
        $home_movies = [];
        $home_categories =  DB::table('sub_category')->where('main_category_name',$name)->orderBy('ordering')->limit(3)->offset(0)->get(['name', 'display_name']);
        foreach($home_categories as $home){
            $home_item ['name'] =   $home->name;
            $home_item ['display_name'] =   $home->display_name;
            $movies = DB::table(Table::MOVIES.' as m')->
            join(Table::HOME_CATEGORIES_VISIBILITY.' as hcv', 'm.name', '=', 'hcv.movie_name')->
            leftJoin('user_favourites as uf', function($query){
                $user_id = 0;
                if(auth('sanctum')->user()){
                    $user_id = auth('sanctum')->user()->id;
                }
                return $query->on('m.name', '=', 'uf.movie_name')->on('uf.user_id', '=', DB::raw("'$user_id'"));
            })->
            where('hcv.home_category_name', '=', $home->name)->
            get([
                'm.name',
                'm.display_name',
                'm.length',
                'm.description',
                'm.imdb',
                'm.play_mode',
                DB::raw("if(m.tumbnail = '', '', CONCAT('$this->path', m.tumbnail)) as thumbnail"),
                DB::raw("if(uf.id != '', 'true', 'false') as favourite")
            ]);

            $home_item ['movies'] = $movies;

            $home_movies [] = $home_item;
        }

//        return $home_movies;
        $data = [
            'feature' => $feature,
            'home_categories' => $home_movies,
        ];
        return response($data);
    }

}
